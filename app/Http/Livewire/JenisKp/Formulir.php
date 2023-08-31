<?php

namespace App\Http\Livewire\JenisKp;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterJenisKp;

class Formulir extends Component
{
    public $sid;
    public $method;
    public $next;

    public $dataset;
    public $lblStts = 'Tidak Aktif';

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? null,
            'status' => $this->dataset['status'] ?? 0,
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jenis_kp',
            'nama' => 'required|unique:master_jenis_kp',
        ],[
            'id.required' => 'ID Jenis Kenaikan Pangkat tidak boleh kosong',
            'id.unique' => 'ID Jenis Kenaikan Pangkat Telah terdaftar',

            'nama.required' => 'Nama Jenis Kenaikan Pangkat tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Kenaikan Pangkat Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisKp::create($retData);

        return redirect('/jenis_kp')->with([
            'success'=> "Data Master Jenis Kenaikan Pangkat Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? null,
            'status' => $this->dataset['status'] ?? 0,
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required',
                Rule::unique('master_eselon')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Jenis Kenaikan Pangkat tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Kenaikan Pangkat Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisKP::find($this->sid)->update($retData);

        return redirect('/jenis_kp')->with([
            'success'=> "Data Master Jenis Kenaikan Pangkat Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-kp.formulir');
    }

    public function changeStts($selId)
    {
        $this->lblStts = $selId == true ? 'Aktif' : 'Tidak Aktif';
    }

    public function mount()
    {
        if($this->sid != ''){
            $dataset = MasterJenisKP::find($this->sid);

            if($dataset){
                $this->changeStts($dataset->status);
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'ref_simpeg' => $dataset->ref_simpeg,
                    'status' => $dataset->status,
                ];
            }
        }
    }
}
