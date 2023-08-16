<?php

namespace App\Http\Livewire\KelJab;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterKelJab;
use App\Models\MasterJenisJabUmum;
use App\Models\MasterInstansi;
use App\Models\MasterRumpunJafung;

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
            'jenis_jabatan_id' => $this->dataset['jenis_jabatan_id'] ?? '',
            'rumpun_jabatan_id' => $this->dataset['rumpun_jabatan_id'] ?? '',
            'pembina_id' => $this->dataset['pembina_id'] ?? '',
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_kelompok_jabatan',
            'nama' => 'required|unique:master_kelompok_jabatan',
            'jenis_jabatan_id' => 'required|unique:master_kelompok_jabatan',
        ],[
            'id.required' => 'ID Kelompok Jabatan tidak boleh kosong',
            'id.unique' => 'ID Kelompok Jabatan Telah terdaftar',

            'nama.required' => 'Nama Kelompok Jabatan tidak boleh kosong',
            'nama.unique' => 'Nama Kelompok Jabatan Telah terdaftar',

            'jenis_jabatan_id.required' => 'Jenis Jabatan belum dipilih',
            'jenis_jabatan_id.unique' => 'Jenis Jabatan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterKelJab::create($retData);

        return redirect('/kel_jab')->with([
            'success'=> "Data Master Kelompok Jabatan Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        //dd($this->dataset);
        $retData = [
            //'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'jenis_jabatan_id' => $this->dataset['jenis_jabatan_id'] ?? '',
            'rumpun_jabatan_id' => $this->dataset['rumpun_jabatan_id'] ?? '',
            'pembina_id' => $this->dataset['pembina_id'] ?? '',
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                Rule::unique('master_kelompok_jabatan')->ignore($id),
            ],
            'jenis_jabatan_id' => [
                'required', 
                Rule::unique('master_kelompok_jabatan')->ignore($id),
            ],
            
        ],[
            'nama.required' => 'Nama Kelompok Jabatan tidak boleh kosong',
            'nama.unique' => 'Nama Kelompok Jabatan Telah terdaftar',

            'jenis_jabatan_id.required' => 'Jenis Jabatan belum dipilih',
            'jenis_jabatan_id.unique' => 'Jenis Jabatan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        MasterKelJab::find($this->sid)->update($retData);

        return redirect('/kel_jab')->with([
            'success'=> "Data Master Kelompok Jabatan Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.kel-jab.formulir', [
            'master_jenis_jabatan_umum' => MasterJenisJabUmum::all(),
            'master_instansi' => MasterInstansi::all(),
            'master_rumpun_jabfung' => MasterRumpunJafung::all()
        ]);
    }

    public function mount(){
        if($this->sid != ""){
            $dataset = MasterKelJab::find($this->sid);
            //dd($dataset);
            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'jenis_jabatan_id' => $dataset->jenis_jabatan_id,
                    'rumpun_jabatan_id' => $dataset->rumpun_jabatan_id,
                    'pembina_id' => $dataset->pembina_id,
                ];
            }
        }
    }
}
