<?php

namespace App\Http\Livewire\ArsipElektronik;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterJenisProfesi;
use App\Models\VPegawai;
use App\Models\MasterJenisArsip;
use App\Models\MasterGroupArsip;

class Formulir extends Component
{
    public $sid;
    public $method;
    public $next;
    public $dataset;

    public $nama;
    public $group_arsip_id;

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
        $retData = MasterJenisArsip::where(function($query){
            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->group_arsip_id != ""){
                $query->where('group_arsip_id', '=', $this->group_arsip_id);
            }
        })->orderBy('group_arsip_id', 'asc')->get();
        return view('livewire.arsip-elektronik.formulir', [
            'lsArsip' => $retData,
            'master_group_arsip' => MasterGroupArsip::all(),
        ]);
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = VPegawai::where('nip', '=', $this->sid)->first();

            if($dataset){
                $this->dataset = [
                    'nip' => $dataset->nip,
                    'nama' => $dataset->namapeg,
                ];
            }
        }   
    }
}
