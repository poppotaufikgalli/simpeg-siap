<?php

namespace App\Http\Livewire\GroupArsip;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterGroupArsip;

class Formulir extends Component
{
    public $next;
    public $method;
    public $sid;
    public $dataset;

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_group_arsip',
            'nama' => 'required|unique:master_group_arsip',
        ],[
            'id.required' => 'ID Group Arsip tidak boleh kosong',
            'id.unique' => 'ID Group Arsip Telah terdaftar',

            'nama.required' => 'Nama Group Arsip tidak boleh kosong',
            'nama.unique' => 'Nama Group Arsip Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterGroupArsip::create($retData);

        return redirect('/group_arsip')->with([
            'success'=> "Data Master Group Arsip Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            //'grDok' => $this->dataset['grDok'],
            'nama' => $this->dataset['nama'],
        ];

        $validator = Validator::make($retData, [
            //'grDok' => 'required|unique:master_group_arsip',
            'nama' => 'required|unique:master_group_arsip',
        ],[
            //'grDok.required' => 'Kode Group Arsip tidak boleh kosong',
            //'grDok.unique' => 'Kode Group Arsip Telah terdaftar',

            'nama.required' => 'Nama Group Arsip tidak boleh kosong',
            'nama.unique' => 'Nama Group Arsip Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterGroupArsip::find($this->sid)->update($retData);

        return redirect('/group_arsip')->with([
            'success'=> "Data Master Group Arsip Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.group-arsip.formulir');
    }

    public function mount()
    {
        if($this->sid != ''){
            $dataset = MasterGroupArsip::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset['id'],
                    'nama' => $dataset['nama'],
                ];
            }
        }
    }
}
