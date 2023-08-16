<?php

namespace App\Http\Livewire\Pendidikan;

use Livewire\Component;

use App\Models\MasterPendidikan;
use App\Models\MasterTingkatPendidikan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Formulir extends Component
{
    public $sid;
    public $next;
    public $method;
    public $dataset;

    public $lblStts = 'Tidak Aktif';

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'tk_pendidikan_id' => $this->dataset['tk_pendidikan_id'] ?? null,
            'status' => $this->dataset['status'] == true ? 1 : 0,
        ];

        if(isset($this->ref_bkn)){
            $retData['ref_bkn'] = $this->dataset['ref_bkn'];
        }

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_pendidikan',
            'nama' => 'required|unique:master_pendidikan',
            'ref_bkn' => 'sometimes|unique:master_pendidikan',
            'tk_pendidikan_id' => 'required',
        ],[
            'id.required' => 'ID Pendidikan tidak boleh kosong',
            'id.unique' => 'ID Pendidikan Telah terdaftar',

            'nama.required' => 'Nama Pendidikan tidak boleh kosong',
            'nama.unique' => 'Nama Pendidikan Telah terdaftar',

            'ref_bkn.required' => 'Nomor Referensi BKN tidak boleh kosong',
            'ref_bkn.unique' => 'Nomor Referensi BKN Telah terdaftar',

            'tk_pendidikan_id.required' => 'Tingkat Pendidikan tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterPendidikan::create($retData);

        return redirect('/pendidikan')->with([
            'success'=> "Data Master Jurusan Pendidikan Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'tk_pendidikan_id' => $this->dataset['tk_pendidikan_id'] ?? null,
            'ref_bkn' => $this->dataset['ref_bkn'],
            'status' => $this->dataset['status'] == true ? 1 : 0,
        ];

        /*if(isset($this->ref_bkn)){
            $retData['ref_bkn'] = $this->dataset['ref_bkn'];
        }*/

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => ['required', Rule::unique('master_pendidikan')->ignore($id)],
            'tk_pendidikan_id' => 'required',
            'ref_bkn' => ['sometimes', Rule::unique('master_pendidikan')->ignore($id)],
        ],[
            'nama.required' => 'Nama Pendidikan tidak boleh kosong',
            'nama.unique' => 'Nama Pendidikan Telah terdaftar',

            'tk_pendidikan_id.required' => 'Tingkat Pendidikan tidak boleh kosong',

            'ref_bkn.unique' => 'Nomor Referensi BKN Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterPendidikan::find($this->sid)->update($retData);

        return redirect('/pendidikan')->with([
            'success'=> "Data Master Jurusan Pendidikan Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.pendidikan.formulir', [
            'master_tingkat_pendidikan' => MasterTingkatPendidikan::all(),
        ]);
    }

    public function changeStts($selId){
        $this->lblStts = $selId == 1 ? "Aktif" : "Tidak Aktif";   
    }

    public function mount(){
        if($this->sid != ""){
            $dataset = MasterPendidikan::find($this->sid);

            if($dataset){
                $this->changeStts($dataset->status);

                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'tk_pendidikan_id' => $dataset->tk_pendidikan_id,
                    'ref_bkn' => $dataset->ref_bkn,
                    'status' => $dataset->status,
                ];
            }
        }
    }
}