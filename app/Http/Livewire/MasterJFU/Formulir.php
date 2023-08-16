<?php

namespace App\Http\Livewire\MasterJfu;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterJfu;

class Formulir extends Component
{
    public $sid;
    public $method;
    public $next;

    public $dataset;
    public $lblStts = "Tidak Aktif";

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'cepat_kode' => $this->dataset['cepat_kode'] ?? '',
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? '',
            'status' => $this->dataset['status'] ?? 0,
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jabatan_fu',
            'nama' => 'required|unique:master_jabatan_fu',
            'cepat_kode' => 'sometimes|required|unique:master_jabatan_fu',
        ],[
            'id.required' => 'Kode Jabatan FU tidak boleh kosong',
            'id.unique' => 'Kode Jabatan FU Telah terdaftar',

            'nama.required' => 'Nama Jabatan FU tidak boleh kosong',
            'nama.unique' => 'Nama Jabatan FU Telah terdaftar',

            'cepat_kode.required' => 'Kode Cepat Jabatan FU tidak boleh kosong',
            'cepat_kode.unique' => 'Kode Cepat Jabatan FU Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterJfu::create($retData);

        return redirect('/master_jfu')->with([
            'success'=> "Data Master Jabatan FU Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            //'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'cepat_kode' => $this->dataset['cepat_kode'] ?? '',
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? '',
            'status' => $this->dataset['status'] ?? 0,
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                Rule::unique('master_jabatan_fu')->ignore($id),
            ],
            'cepat_kode' => [
                'required', 
                Rule::unique('master_jabatan_fu')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Jabatan FU tidak boleh kosong',
            'nama.unique' => 'Nama Jabatan FU Telah terdaftar',

            'cepat_kode.required' => 'Kode Cepat Jabatan FU tidak boleh kosong',
            'cepat_kode.unique' => 'Kode Cepat Jabatan FU Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterJfu::find($this->sid)->update($retData);

        return redirect('/master_jfu')->with([
            'success'=> "Data Master Jabatan FU Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.master-jfu.formulir');
    }

    public function changeStts($selId)
    {
        $this->lblStts = $selId == 1 ? "Aktif" : 'Tidak Aktif';
    }

    public function mount()
    {
        if($this->sid){
            $dataset = MasterJfu::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'status' => $dataset->status, 
                    'cepat_kode' => $dataset->cepat_kode,
                    'ref_simpeg' => $dataset->ref_simpeg,
                ];
            }
        }
    }
}
