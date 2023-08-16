<?php

namespace App\Http\Livewire\JenisKursus;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterJenisKursus;

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
            'cepat_kode' => $this->dataset['cepat_kode'],
            'ref_simpeg' => $this->dataset['ref_simpeg'],
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jenis_kursus',
            'nama' => 'required|unique:master_jenis_kursus',
            'cepat_kode' => 'required|unique:master_jenis_kursus',
        ],[
            'id.required' => 'ID Kursus tidak boleh kosong',
            'id.unique' => 'ID Kursus Telah terdaftar',

            'nama.required' => 'Nama Kursus tidak boleh kosong',
            'nama.unique' => 'Nama Kursus Telah terdaftar',

            'cepat_kode.required' => 'Nama Kode Cepat tidak boleh kosong',
            'cepat_kode.unique' => 'Nama Kode Cepat Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisKursus::create($retData);

        return redirect('/jenis_kursus')->with([
            'success'=> "Data Master Kursus Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'cepat_kode' => $this->dataset['cepat_kode'],
            'ref_simpeg' => $this->dataset['ref_simpeg'],
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                Rule::unique('master_jenis_kursus')->ignore($id),
            ],
            'cepat_kode' => [
                'required', 
                Rule::unique('master_jenis_kursus')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Kursus tidak boleh kosong',
            'nama.unique' => 'Nama Kursus Telah terdaftar',

            'cepat_kode.required' => 'Nama Kode Cepat tidak boleh kosong',
            'cepat_kode.unique' => 'Nama Kode Cepat Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterJenisKursus::find($this->sid)->update($retData);

        return redirect('/jenis_kursus')->with([
            'success'=> "Data Master Kursus Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-kursus.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJenisKursus::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'cepat_kode' => $dataset->cepat_kode,
                    'ref_simpeg' => $dataset->ref_simpeg,
                ];
            }
        }   
    }
}
