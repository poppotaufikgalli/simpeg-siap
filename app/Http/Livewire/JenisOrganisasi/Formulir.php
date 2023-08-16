<?php

namespace App\Http\Livewire\JenisOrganisasi;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterJenisOrganisasi;

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
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jenis_organisasi',
            'nama' => 'required|unique:master_jenis_organisasi',
        ],[
            'id.required' => 'ID Jenis Organisasi tidak boleh kosong',
            'id.unique' => 'ID Jenis Organisasi Telah terdaftar',

            'nama.required' => 'Nama Jenis Organisasi tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Organisasi Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisOrganisasi::create($retData);

        return redirect('/jenis_organisasi')->with([
            'success'=> "Data Master Jenis Organisasi Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                Rule::unique('master_jenis_organisasi')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Jenis Organisasi tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Organisasi Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterJenisOrganisasi::find($this->sid)->update($retData);

        return redirect('/jenis_organisasi')->with([
            'success'=> "Data Master Jenis Organisasi Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-organisasi.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJenisOrganisasi::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                ];
            }
        }   
    }
}
