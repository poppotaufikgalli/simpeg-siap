<?php

namespace App\Http\Livewire\Agama;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterAgama;

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
            'id' => 'required|unique:master_agama',
            'nama' => 'required|unique:master_agama',
        ],[
            'id.required' => 'ID Agama tidak boleh kosong',
            'id.unique' => 'ID Agama Telah terdaftar',

            'nama.required' => 'Nama Agama tidak boleh kosong',
            'nama.unique' => 'Nama Agama Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterAgama::create($retData);

        return redirect('/agama')->with([
            'success'=> "Data Master Agama Terkait berhasil ditambahkan."
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
                Rule::unique('master_agama')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Agama tidak boleh kosong',
            'nama.unique' => 'Nama Agama Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterAgama::find($this->sid)->update($retData);

        return redirect('/agama')->with([
            'success'=> "Data Master Agama Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.agama.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterAgama::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                ];
            }
        }   
    }
}
