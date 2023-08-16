<?php

namespace App\Http\Livewire\JenisPengadaan;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterJenisPengadaan;

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
            'id' => 'required|unique:master_jenis_pengadaan',
            'nama' => 'required|unique:master_jenis_pengadaan',
        ],[
            'id.required' => 'ID Pengadaan tidak boleh kosong',
            'id.unique' => 'ID Pengadaan Telah terdaftar',

            'nama.required' => 'Nama Pengadaan tidak boleh kosong',
            'nama.unique' => 'Nama Pengadaan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisPengadaan::create($retData);

        return redirect('/jenis_pengadaan')->with([
            'success'=> "Data Master Pengadaan Terkait berhasil ditambahkan."
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
                Rule::unique('master_jenis_pengadaan')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Pengadaan tidak boleh kosong',
            'nama.unique' => 'Nama Pengadaan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterJenisPengadaan::find($this->sid)->update($retData);

        return redirect('/jenis_pengadaan')->with([
            'success'=> "Data Master Pengadaan Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-pengadaan.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJenisPengadaan::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                ];
            }
        }   
    }
}
