<?php

namespace App\Http\Livewire\JenisKawin;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterJenisKawin;

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
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jenis_kawin',
            'nama' => 'required|unique:master_jenis_kawin',
        ],[
            'id.required' => 'ID Jenis Kawin tidak boleh kosong',
            'id.unique' => 'ID Jenis Kawin Telah terdaftar',

            'nama.required' => 'Nama Jenis Kawin tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Kawin Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisKawin::create($retData);

        return redirect('/jenis_kawin')->with([
            'success'=> "Data Master Jenis Kawin Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? '',
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
            ],
        ],[
            'nama.required' => 'Nama Jenis Kawin tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterJenisKawin::find($this->sid)->update($retData);

        return redirect('/jenis_kawin')->with([
            'success'=> "Data Master Jenis Kawin Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-kawin.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJenisKawin::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'ref_simpeg' => $dataset->ref_simpeg,
                ];
            }
        }   
    }
}
