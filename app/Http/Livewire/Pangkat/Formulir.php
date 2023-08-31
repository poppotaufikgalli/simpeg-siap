<?php

namespace App\Http\Livewire\Pangkat;

use Livewire\Component;

use App\Models\MasterPangkat;
use App\Models\MasterKorps;
use App\Models\MasterJenisPersonel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Formulir extends Component
{
    public $next;
    public $method;
    public $sid;
    public $dataset;

    public function store(){
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'] ?? '',
            'nama_pangkat' => $this->dataset['nama_pangkat'],
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? null,
            'pajak' => $this->dataset['pajak'] ?? '0',
            'id_jenis_personel' => $this->dataset['id_jenis_personel'],
            'id_korps' => $this->dataset['id_korps'],
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_pangkat',
            //'nama' => 'required|unique:master_pangkat',
            'nama_pangkat' => 'required|unique:master_pangkat,nama_pangkat,korps',
        ],[
            'id.required' => 'Id Pangkat tidak boleh kosong',
            'id.unique' => 'Id Pangkat Telah terdaftar',

            //'nama.required' => 'Kode Nama Pangkat tidak boleh kosong',
            //'nama.unique' => 'Kode Nama Pangkat Telah terdaftar',

            'nama_pangkat.required' => 'Nama Golongan Ruang Pangkat tidak boleh kosong',
            'nama_pangkat.unique' => 'Nama Golongan Ruang Pangkat Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterPangkat::create($retData);

        return redirect('/pangkat')->with([
            'success'=> "Data Master Pangkat Terkait berhasil ditambahkan."
        ]);
    }

    public function update(){
        $retData = [
            //'id_pangkat' => $this->dataset['id_pangkat'],
            'nama' => $this->dataset['nama'] ?? '',
            'nama_pangkat' => $this->dataset['nama_pangkat'],
            'ref_simpeg' => $this->dataset['ref_simpeg'],
            'pajak' => $this->dataset['pajak'] ?? '0',
            'id_korps' => $this->dataset['id_korps'],
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            //'id_pangkat' => 'required|unique:master_pangkat',
            //'nama' => ['required', Rule::unique('master_pangkat')->ignore($id)],
            'nama_pangkat' => [
                'required', 
                Rule::unique('master_pangkat')->where(function($query) use($retData){
                    return $query->where('nama_pangkat', '=', $retData['nama_pangkat'])
                        ->where('id_korps', '=', $retData['id_korps']);
                })->ignore($id)
            ],
        ],[
            //'id_pangkat.required' => 'Id Pangkat tidak boleh kosong',
            //'id_pangkat.unique' => 'Id Pangkat Telah terdaftar',

            //'nama.required' => 'Kode Nama Pangkat tidak boleh kosong',
            //'nama.unique' => 'Kode Nama Pangkat Telah terdaftar',

            'nama_pangkat.required' => 'Nama Golongan Ruang Pangkat tidak boleh kosong',
            'nama_pangkat.unique' => 'Nama Golongan Ruang Pangkat Telah terdaftar.a',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterPangkat::where('id', '=', $this->sid)->update($retData);

        return redirect('/pangkat')->with([
            'success'=> "Data Master Pangkat Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.pangkat.formulir', [
            'master_jenis_personel' => MasterJenisPersonel::where('stts', '=', 1)->get(),
            'master_korps' => MasterKorps::where('status', '=', 1)->get(),
        ]);
    }

    public function mount(){
        if($this->sid != ""){
            $dataset = MasterPangkat::where('id' , '=', $this->sid)->first();

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'nama_pangkat' => $dataset->nama_pangkat,
                    'ref_simpeg' => $dataset->ref_simpeg,
                    'pajak' => $dataset->pajak,
                    'id_jenis_personel' => $dataset->id_jenis_personel,
                    'id_korps' => $dataset->id_korps,
                ];
            }
        }
    }
}
