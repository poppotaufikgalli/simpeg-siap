<?php

namespace App\Http\Livewire\RefJabatan;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use  App\Models\MasterReferensiJabatan;

class Formulir extends Component
{
    public $sid;
    public $jenis_jabatan_id;
    public $method;
    public $next;
    public $dataset;

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'bup_usia' => $this->dataset['bup_usia'],
            'jenis_jabatan_id' => $this->jenis_jabatan_id,
            'cepat_kode' => $this->dataset['cepat_kode'],
            'ref_simpeg' => $this->dataset['ref_simpeg'],
        ];

        $validator = Validator::make($retData, [
            'id' => [
                'required', 
                Rule::unique('master_referensi_jabatan')->where(function($query) use($retData){
                    return $query->where('id', $retData['id'])->where('jenis_jabatan_id', $this->jenis_jabatan_id);
                }),
            ],
            'nama' => 'required|unique:master_referensi_jabatan',
        ],[
            'id.required' => 'ID Jabatan tidak boleh kosong',
            'id.unique' => 'ID Jabatan Telah terdaftar',

            'nama.required' => 'Nama Jabatan tidak boleh kosong',
            'nama.unique' => 'Nama Jabatan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterReferensiJabatan::create($retData);

        return redirect('/ref_jabatan/'.$this->jenis_jabatan_id)->with([
            'success'=> "Data Master Jabatan Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'bup_usia' => $this->dataset['bup_usia'],
            'cepat_kode' => $this->dataset['cepat_kode'],
            'ref_simpeg' => $this->dataset['ref_simpeg'],
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                Rule::unique('master_referensi_jabatan')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Jabatan tidak boleh kosong',
            'nama.unique' => 'Nama Jabatan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterReferensiJabatan::find($this->sid)->update($retData);

        return redirect('/ref_jabatan/'.$this->jenis_jabatan_id)->with([
            'success'=> "Data Master Jabatan Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.ref-jabatan.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterReferensiJabatan::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'bup_usia' => $dataset->bup_usia,
                    'cepat_kode' => $dataset->cepat_kode,
                    'ref_simpeg' => $dataset->ref_simpeg,
                ];
            }
        }   
    }
}
