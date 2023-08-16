<?php

namespace App\Http\Livewire\JenisPegawai;

use Livewire\Component;

use App\Models\MasterJenisPegawai;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Formulir extends Component
{
    public $next;
    public $method;
    public $lblStts = "Tidak Aktif";

    public $sid;
    public $dataset;

    public function store()
    {
        $retData = [
            'id' => $this->dataset['id'],
            'nama' => $this->dataset['nama'],
            'status' => isset($this->dataset['status']) && $this->dataset['status'] == 'on' ? 1 : 0, 
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? '',
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_jenis_pegawai',
            'nama' => 'required|unique:master_jenis_pegawai',
        ],[
            'id.required' => 'Kode Jenis Pegawai tidak boleh kosong',
            'id.unique' => 'Kode Jenis Pegawai Telah terdaftar',

            'nama.required' => 'Nama Jenis Pegawai tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Pegawai Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterJenisPegawai::create($retData);

        return redirect('/jenis_pegawai')->with([
            'success'=> "Data Master Jenis Pegawai Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'status' => ($this->dataset['status'] == 'on' ||  $this->dataset['status'] == 1) ? 1 : 0, 
            'ref_simpeg' => $this->dataset['ref_simpeg'],
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            //'kjpeg' => 'required|unique:master_jenis_pegawai',
            'nama' => ['required', Rule::unique('master_jenis_pegawai')->ignore($id)],
        ],[
            //'kjpeg.required' => 'Kode Jenis Pegawai tidak boleh kosong',
            //'kjpeg.unique' => 'Kode Jenis Pegawai Telah terdaftar',

            'nama.required' => 'Nama Jenis Pegawai tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Pegawai Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterJenisPegawai::find($this->sid)->update($retData);

        return redirect('/jenis_pegawai')->with([
            'success'=> "Data Master Jenis Pegawai Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.jenis-pegawai.formulir');
    }

    public function changeStts($selId){
        $this->lblStts = $selId ? "Aktif" : "Tidak Aktif";
    }

    public function mount()
    {
        //dd($this->sid);
        if($this->sid != ""){
            $dataset = MasterJenisPegawai::find($this->sid)->first();
        
            if($dataset) {
                $this->changeStts($dataset->status);
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'status' => $dataset->status,
                    'ref_simpeg' => $dataset->ref_simpeg,
                ];
            }    
        }
    }
}
