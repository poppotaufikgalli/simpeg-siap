<?php

namespace App\Http\Livewire\JenisHukdis;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterJenisHukdis;

class Formulir extends Component
{
    public $sid;
    public $method;
    public $next;
    public $dataset;

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? '',
            'jenis_tingkat_hukuman_id' => $this->dataset['jenis_tingkat_hukuman_id'] ?? '',
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jenis_hukdis',
            'nama' => 'required|unique:master_jenis_hukdis',
            'jenis_tingkat_hukuman_id' => 'required',
        ],[
            'id.required' => 'ID Jenis Hukuman Disiplin tidak boleh kosong',
            'id.unique' => 'ID Jenis Hukuman Disiplin Telah terdaftar',

            'nama.required' => 'Nama Jenis Hukuman Disiplin tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Hukuman Disiplin Telah terdaftar',

            'jenis_tingkat_hukuman_id.required' => 'Tingkat Jenis Hukuman Disiplin tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisHukdis::create($retData);

        return redirect('/jenis_hukdis')->with([
            'success'=> "Data Master Jenis Hukuman Disiplin Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? '',
            'jenis_tingkat_hukuman_id' => $this->dataset['jenis_tingkat_hukuman_id'] ?? '',
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
            ],
        ],[
            'nama.required' => 'Nama Jenis Hukuman Disiplin tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterJenisHukdis::find($this->sid)->update($retData);

        return redirect('/jenis_hukdis')->with([
            'success'=> "Data Master Jenis Hukuman Disiplin Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-hukdis.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJenisHukdis::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'ref_simpeg' => $dataset->ref_simpeg,
                    'jenis_tingkat_hukuman_id' => $dataset->jenis_tingkat_hukuman_id,
                ];
            }
        }   
    }
}
