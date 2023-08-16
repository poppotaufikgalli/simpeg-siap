<?php

namespace App\Http\Livewire\Instansi;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterInstansi;
use App\Models\MasterJenisInstansi;

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
            'jenis' => $this->dataset['jenis'] ?? '',
            'jenis_instansi_id' => $this->dataset['jenis_instansi_id'] ?? '',
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_instansi',
            'nama' => 'required|unique:master_instansi',
            'jenis' => 'required',
            'jenis_instansi_id' => 'required',
        ],[
            'id.required' => 'ID Instansi tidak boleh kosong',
            'id.unique' => 'ID Instansi Telah terdaftar',

            'nama.required' => 'Nama Instansi tidak boleh kosong',
            'nama.unique' => 'Nama Instansi Telah terdaftar',

            'jenis.required' => 'Jenis/Group Instansi tidak boleh kosong',
            'jenis_instansi_id.required' => 'Jenis/Group Instansi tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterInstansi::create($retData);

        return redirect('/instansi')->with([
            'success'=> "Data Master Instansi Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'jenis' => $this->dataset['jenis'] ?? '',
            'jenis_instansi_id' => $this->dataset['jenis_instansi_id'] ?? '',
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                Rule::unique('master_instansi')->ignore($id),
            ],
            'jenis' => 'required',
            'jenis_instansi_id' => 'required',
        ],[
            'nama.required' => 'Nama Instansi tidak boleh kosong',
            'nama.unique' => 'Nama Instansi Telah terdaftar',

            'jenis.required' => 'Jenis/Group Instansi tidak boleh kosong',
            'jenis_instansi_id.required' => 'Jenis/Group Instansi tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterInstansi::find($this->sid)->update($retData);

        return redirect('/instansi')->with([
            'success'=> "Data Master Instansi Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.instansi.formulir', [
            'master_jenis_instansi' => MasterJenisInstansi::all(),
        ]);
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterInstansi::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'jenis' => $dataset->jenis,
                    'jenis_instansi_id' => $dataset->jenis_instansi_id,
                ];
            }
        }   
    }
}
