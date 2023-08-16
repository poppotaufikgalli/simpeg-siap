<?php

namespace App\Http\Livewire\JenisKompetensi;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterJenisKompetensi;

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
            'nama_id' => $this->dataset['nama_id'],
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jenis_kompetensi',
            'nama' => 'required|unique:master_jenis_kompetensi',
            'nama_id' => 'required|unique:master_jenis_kompetensi',
        ],[
            'id.required' => 'ID Kompetensi tidak boleh kosong',
            'id.unique' => 'ID Kompetensi Telah terdaftar',

            'nama.required' => 'Nama Kompetensi tidak boleh kosong',
            'nama.unique' => 'Nama Kompetensi Telah terdaftar',

            'nama_id.required' => 'Singkatan Kompetensi tidak boleh kosong',
            'nama_id.unique' => 'Singkatan Kompetensi Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisKompetensi::create($retData);

        return redirect('/jenis_kompetensi')->with([
            'success'=> "Data Master Kompetensi Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'nama_id' => $this->dataset['nama_id'],
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                Rule::unique('master_jenis_kompetensi')->ignore($id),
            ],
            'nama_id' => [
                'required', 
                Rule::unique('master_jenis_kompetensi')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Kompetensi tidak boleh kosong',
            'nama.unique' => 'Nama Kompetensi Telah terdaftar',

            'nama_id.required' => 'Singkatan Kompetensi tidak boleh kosong',
            'nama_id.unique' => 'Singkatan Kompetensi Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterJenisKompetensi::find($this->sid)->update($retData);

        return redirect('/jenis_kompetensi')->with([
            'success'=> "Data Master jenis_kompetensi Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-kompetensi.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJenisKompetensi::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'nama_id' => $dataset->nama_id,
                ];
            }
        }   
    }
}
