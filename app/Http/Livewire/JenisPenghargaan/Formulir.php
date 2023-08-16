<?php

namespace App\Http\Livewire\JenisPenghargaan;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterJenisPenghargaan;

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
            'id' => 'required|unique:master_jenis_penghargaan',
            'nama' => 'required|unique:master_jenis_penghargaan',
        ],[
            'id.required' => 'ID Penghargaan tidak boleh kosong',
            'id.unique' => 'ID Penghargaan Telah terdaftar',

            'nama.required' => 'Nama Penghargaan tidak boleh kosong',
            'nama.unique' => 'Nama Penghargaan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisPenghargaan::create($retData);

        return redirect('/jenis_penghargaan')->with([
            'success'=> "Data Master Jenis Penghargaan Terkait berhasil ditambahkan."
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
                Rule::unique('master_jenis_penghargaan')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Jenis Penghargaan tidak boleh kosong',
            'nama.unique' => 'Nama Penghargaan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterJenisPenghargaan::find($this->sid)->update($retData);

        return redirect('/jenis_penghargaan')->with([
            'success'=> "Data Master Jenis Penghargaan Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-penghargaan.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJenisPenghargaan::find($this->sid);

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
