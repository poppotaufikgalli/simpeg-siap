<?php

namespace App\Http\Livewire\JenisJabatan;

use Livewire\Component;

use App\Models\MasterJenisJabatan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Formulir extends Component
{
    public $next;
    public $method;
    public $lblStts = "Tidak Aktif";
    public $lblAk = "Tidak";

    public $sid;
    public $dataset;

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? '',
            'ref_siap' => $this->dataset['ref_siap'] ?? '',
            'is_ak' => isset($this->dataset['is_ak']) && $this->dataset['is_ak'] == 'on' ? 1 : 0, 
            'status' => isset($this->dataset['status']) && $this->dataset['status'] == 'on' ? 1 : 0, 
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jenis_jabatan',
            'nama' => 'required|unique:master_jenis_jabatan',
        ],[
            'id.required' => 'Kode Jenis Jabatan tidak boleh kosong',
            'id.unique' => 'Kode Jenis Jabatan Telah terdaftar',

            'nama.required' => 'Nama Jenis Jabatan tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Jabatan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterJenisJabatan::create($retData);

        return redirect('/jenis_jabatan')->with([
            'success'=> "Data Master Jenis Jabatan Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'ref_simpeg' => $this->dataset['ref_simpeg'],
            'ref_siap' => $this->dataset['ref_siap'],
            'is_ak' => ($this->dataset['is_ak'] == 'on' ||  $this->dataset['is_ak'] == 1) ? 1 : 0, 
            'status' => ($this->dataset['status'] == 'on' ||  $this->dataset['status'] == 1) ? 1 : 0, 
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                Rule::unique('master_jenis_jabatan')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Jenis Jabatan tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Jabatan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterJenisJabatan::find($this->sid)->update($retData);

        return redirect('/jenis_jabatan')->with([
            'success'=> "Data Master Jenis Jabatan Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-jabatan.formulir');
    }

    public function changeStts($selId){
        $this->lblStts = $selId ? "Aktif" : "Tidak Aktif";
    }

    public function changeAk($selId){
        $this->lblAk = $selId ? "Ya" : "Tidak";
    }

    public function mount()
    {
        if($this->sid > 0){
            $dataset = MasterJenisJabatan::find($this->sid);
        
            if($dataset) {
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'ref_simpeg' => $dataset->ref_simpeg,
                    'ref_siap' => $dataset->ref_siap,
                    'is_ak' => $dataset->is_ak,
                    'status' => $dataset->status,
                ];
                $this->changeStts($dataset->status);
            }    
        }
        
    }
}