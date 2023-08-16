<?php

namespace App\Http\Livewire\KedudukanPegawai;

use Livewire\Component;

use App\Models\MasterKedudukanPegawai;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Formulir extends Component
{
    public $sid;
    public $next;
    public $method;
    
    public $dataset;

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? null,
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_kedudukan_pegawai',
            'nama' => 'required|unique:master_kedudukan_pegawai',
        ],[
            'id.required' => 'ID Kedudukan Hukum Pegawai tidak boleh kosong',
            'id.unique' => 'ID Kedudukan Hukum Pegawai Telah terdaftar',

            'nama.required' => 'Nama Kedudukan Hukum Pegawai tidak boleh kosong',
            'nama.unique' => 'Nama Kedudukan Hukum Pegawai Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterKedudukanPegawai::create($retData);

        return redirect('/kedudukan_pegawai')->with([
            'success'=> "Data Kedudukan Hukum Pegawai Terkait berhasil ditambahkan."
        ]);
    }

    public function update(){
        $retData = [
            'nama' => $this->dataset['nama'],
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? null,
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => ['required', Rule::unique('master_kedudukan_pegawai')->ignore($id)],
        ],[
            'nama.required' => 'Nama Kedudukan Hukum Pegawai tidak boleh kosong',
            'nama.unique' => 'Nama Kedudukan Hukum Pegawai Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterKedudukanPegawai::find($this->sid)->update($retData);

        return redirect('/kedudukan_pegawai')->with([
            'success'=> "Data Kedudukan Hukum Pegawai Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.kedudukan-pegawai.formulir');
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterKedudukanPegawai::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'ref_simpeg' => $dataset->ref_simpeg,
                ];
            }
        }
    }
}
