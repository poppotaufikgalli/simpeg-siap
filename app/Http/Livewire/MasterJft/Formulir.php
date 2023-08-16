<?php

namespace App\Http\Livewire\MasterJft;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterJft;
use App\Models\MasterKelJab;
use App\Models\MasterJenjangJafung;

class Formulir extends Component
{
    public $sid;
    public $method;
    public $next;

    public $dataset;
    public $lblStts = "Tidak Berlaku";

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'cepat_kode' => $this->dataset['cepat_kode'] ?? '',
            'kel_jabatan_id' => $this->dataset['kel_jabatan_id'] ?? '',
            'bup_usia' => $this->dataset['bup_usia'] ?? '', 
            'jenjang' => $this->dataset['jenjang'] ?? '',
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? '',
            'status' => $this->dataset['status'] =='1' ? 'N' : 'O',
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jabatan_ft',
            'nama' => 'required|unique:master_jabatan_ft',
            'cepat_kode' => 'sometimes|required|unique:master_jabatan_ft',
        ],[
            'id.required' => 'Kode Jabatan FT tidak boleh kosong',
            'id.unique' => 'Kode Jabatan FT Telah terdaftar',

            'nama.required' => 'Nama Jabatan FT tidak boleh kosong',
            'nama.unique' => 'Nama Jabatan FT Telah terdaftar',

            'cepat_kode.required' => 'Kode Cepat Jabatan FT tidak boleh kosong',
            'cepat_kode.unique' => 'Kode Cepat Jabatan FT Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterJft::create($retData);

        return redirect('/master_jft')->with([
            'success'=> "Data Master Jabatan FT Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            //'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'cepat_kode' => $this->dataset['cepat_kode'] ?? '',
            'kel_jabatan_id' => $this->dataset['kel_jabatan_id'] ?? '',
            'bup_usia' => $this->dataset['bup_usia'] ?? '', 
            'jenjang' => $this->dataset['jenjang'] ?? '',
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? '',
            'status' => $this->dataset['status'] ? 'N' : 'O',
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                Rule::unique('master_jabatan_ft')->ignore($id),
            ],
            'cepat_kode' => [
                'required', 
                Rule::unique('master_jabatan_ft')->ignore($id),
            ],
        ],[
            'nama.required' => 'Nama Jabatan FT tidak boleh kosong',
            'nama.unique' => 'Nama Jabatan FT Telah terdaftar',

            'cepat_kode.required' => 'Kode Cepat Jabatan FT tidak boleh kosong',
            'cepat_kode.unique' => 'Kode Cepat Jabatan FT Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterJft::find($this->sid)->update($retData);

        return redirect('/master_jft')->with([
            'success'=> "Data Master Jabatan FT Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.master-jft.formulir', [
            'master_kelompok_jabatan' => MasterKelJab::all(),
            'master_jenjang_jabfung' => MasterJenjangJafung::all(),
        ]);
    }

    public function changeStts($selId){
        $this->lblStts = $selId == 'N' ? 'Berlaku' : 'Tidak Berlaku';
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterJft::find($this->sid);

            if($dataset) {
                //dd($dataset);
                $this->changeStts($dataset->status);
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'kel_jabatan_id' => $dataset->kel_jabatan_id,
                    'jenjang' => $dataset->jenjang,
                    'status' => $dataset->status == 'N' ? 1 : 0, 
                    'cepat_kode' => $dataset->cepat_kode,
                    'bup_usia' => $dataset->bup_usia,
                    'ref_simpeg' => $dataset->ref_simpeg,
                ];
            }    
        }
    }
}
