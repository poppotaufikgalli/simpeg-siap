<?php

namespace App\Http\Livewire\JenisProfesi;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterJenisProfesi;

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
            'id' => 'required|unique:master_profesi',
            'nama' => 'required|unique:master_profesi',
        ],[
            'id.required' => 'ID Profesi tidak boleh kosong',
            'id.unique' => 'ID Profesi Telah terdaftar',

            'nama.required' => 'Nama Profesi tidak boleh kosong',
            'nama.unique' => 'Nama Profesi Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisProfesi::create($retData);

        return redirect('/jenis_profesi')->with([
            'success'=> "Data Master Profesi Terkait berhasil ditambahkan."
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
                Rule::unique('master_profesi')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Profesi tidak boleh kosong',
            'nama.unique' => 'Nama Profesi Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterJenisProfesi::find($this->sid)->update($retData);

        return redirect('/jenis_profesi')->with([
            'success'=> "Data Master Profesi Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-profesi.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJenisProfesi::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                ];
            }
        }   
    }
}
