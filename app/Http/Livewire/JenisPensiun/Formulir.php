<?php

namespace App\Http\Livewire\JenisPensiun;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterJenisPensiun;

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
            'id' => 'required|unique:master_jenis_pensiun',
            'nama' => 'required|unique:master_jenis_pensiun',
        ],[
            'id.required' => 'ID Jenis Pensiun tidak boleh kosong',
            'id.unique' => 'ID Jenis Pensiun Telah terdaftar',

            'nama.required' => 'Nama Jenis Pensiun tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Pensiun Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisPensiun::create($retData);

        return redirect('/jenis_pensiun')->with([
            'success'=> "Data Master Jenis Pensiun Terkait berhasil ditambahkan."
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
                Rule::unique('master_jenis_pensiun')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Jenis Pensiun tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Pensiun Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterJenisPensiun::find($this->sid)->update($retData);

        return redirect('/jenis_pensiun')->with([
            'success'=> "Data Master Agama Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-pensiun.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJenisPensiun::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                ];
            }
        }   
    }
}
