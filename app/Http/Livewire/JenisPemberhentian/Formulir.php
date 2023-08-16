<?php

namespace App\Http\Livewire\JenisPemberhentian;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterJenisPemberhentian;

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
            'id' => 'required|unique:master_jenis_pemberhentian',
            'nama' => 'required|unique:master_jenis_pemberhentian',
        ],[
            'id.required' => 'ID Jenis Pemberhentian tidak boleh kosong',
            'id.unique' => 'ID Jenis Pemberhentian Telah terdaftar',

            'nama.required' => 'Nama Jenis Pemberhentian tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Pemberhentian Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisPemberhentian::create($retData);

        return redirect('/jenis_pemberhentian')->with([
            'success'=> "Data Master Jenis Pemberhentian Terkait berhasil ditambahkan."
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
                Rule::unique('master_jenis_pemberhentian')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Jenis Pemberhentian tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Pemberhentian Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterJenisPemberhentian::find($this->sid)->update($retData);

        return redirect('/jenis_pemberhentian')->with([
            'success'=> "Data Master Jenis Pemberhentian Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-pemberhentian.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJenisPemberhentian::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                ];
            }
        }   
    }
}
