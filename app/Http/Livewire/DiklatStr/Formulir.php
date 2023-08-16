<?php

namespace App\Http\Livewire\DiklatStr;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterDiklatStr;

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
            'ref_simpeg' => $this->dataset['ref_simpeg'],
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_diklat_str',
            'nama' => 'required|unique:master_diklat_str',
        ],[
            'id.required' => 'ID Diklat Struktural tidak boleh kosong',
            'id.unique' => 'ID Diklat Struktural Telah terdaftar',

            'nama.required' => 'Nama Diklat Struktural tidak boleh kosong',
            'nama.unique' => 'Nama Diklat Struktural Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterDiklatStr::create($retData);

        return redirect('/diklat_str')->with([
            'success'=> "Data Master Diklat Struktural Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'ref_simpeg' => $this->dataset['ref_simpeg'],
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                Rule::unique('master_diklat_str')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Diklat Struktural tidak boleh kosong',
            'nama.unique' => 'Nama Diklat Struktural Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterDiklatStr::find($this->sid)->update($retData);

        return redirect('/diklat_str')->with([
            'success'=> "Data Master Diklat Struktural Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.diklat-str.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterDiklatStr::find($this->sid);

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
