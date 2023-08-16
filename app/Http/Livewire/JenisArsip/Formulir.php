<?php

namespace App\Http\Livewire\JenisArsip;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterGroupArsip;
use App\Models\MasterJenisArsip;

class Formulir extends Component
{
    public $next;
    public $method;
    public $sid;
    
    public $dataset;
    public $lblRiw = "Tidak";

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'group_arsip_id' => $this->dataset['group_arsip_id'],
            'jnsdok' => $this->dataset['jnsdok'],
            'riw' => isset($this->dataset['riw']) && $this->dataset['riw'] == 'on' ? 1 : 0, 
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jenis_arsip',
            'group_arsip_id' => 'required',
            'nama' => 'required|unique:master_jenis_arsip',
            'jnsdok' => 'required|unique:master_jenis_arsip',
        ],[
            'id.required' => 'Kode Arsip tidak boleh kosong',
            'id.unique' => 'Kode Arsip Telah terdaftar',

            'group_arsip_id.required' => 'Group Arsip tidak boleh kosong',

            'nama.required' => 'Nama Arsip tidak boleh kosong',
            'nama.unique' => 'Nama Arsip Telah terdaftar',

            'jnsdok.required' => 'Nama Indeks Arsip tidak boleh kosong',
            'jnsdok.unique' => 'Nama Indeks Arsip Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisArsip::create($retData);

        return redirect('/jenis_arsip')->with([
            'success'=> "Data Jenis Arsip Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            //'kdok' => $this->dataset['kdok'],
            'nama' => $this->dataset['nama'],
            'group_arsip_id' => $this->dataset['group_arsip_id'],
            'jnsdok' => $this->dataset['jnsdok'],
            'riw' => isset($this->dataset['riw']) && ($this->dataset['riw'] == 'on' || $this->dataset['riw'] == true) ? 1 : 0, 
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            //'kdok' => 'required|unique:master_jenis_arsip',
            'group_arsip_id' => 'required',
            'nama'  => [
                'required',
                Rule::unique('master_jenis_arsip')->ignore($id)
            ],
            'jnsdok'  => [
                'required',
                Rule::unique('master_jenis_arsip')->ignore($id)
            ],
        ],[
            'group_arsip_id.required' => 'Group Arsip tidak boleh kosong',

            'nama.required' => 'Nama Arsip tidak boleh kosong',
            'nama.unique' => 'Nama Arsip Telah terdaftar',

            'jnsdok.required' => 'Nama Indeks Arsip tidak boleh kosong',
            'jnsdok.unique' => 'Nama Indeks Arsip Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisArsip::find($this->sid)->update($retData);

        return redirect('/jenis_arsip')->with([
            'success'=> "Data Jenis Arsip Terkait berhasil ditambahkan."
        ]);
    }

    public function mount()
    {
        if($this->sid != ''){
            $dataset = MasterJenisArsip::find($this->sid);
            $this->changeRiw($dataset->riw);
            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'group_arsip_id' => $dataset->group_arsip_id,
                    'jnsdok' => $dataset->jnsdok,
                    'riw' => $dataset->riw,
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.jenis-arsip.formulir', [
            'master_group_arsip' => MasterGroupArsip::all()
        ]);
    }

    public function changeRiw($selId)
    {
        $this->lblRiw = $selId ? 'Ya' : 'Tidak';
    }
}
