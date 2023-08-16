<?php

namespace App\Http\Livewire\TingkatPendidikan;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterTingkatPendidikan;
use App\Models\MasterPangkat;

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
            'group_tk_pend_nm' => $this->dataset['group_tk_pend_nm'],
            'maxkgolru' => $this->dataset['maxkgolru'] ?? null,
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? null,
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_tingkat_pendidikan',
            'nama' => 'required|unique:master_tingkat_pendidikan',
            'group_tk_pend_nm' => 'required',
        ],[
            'id.required' => 'ID Tingkat Pendidikan tidak boleh kosong',
            'id.unique' => 'ID Tingkat Pendidikan Telah terdaftar',

            'nama.required' => 'Nama Tingkat Pendidikan tidak boleh kosong',
            'nama.unique' => 'Nama Tingkat Pendidikan Telah terdaftar',

            'group_tk_pend_nm.required' => 'Nama Group Tingkat Pendidikan tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterTingkatPendidikan::create($retData);

        return redirect('/tingkat_pendidikan')->with([
            'success'=> "Data Master Tingkat Pendidikan Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            //'id' => $this->dataset['_id'],
            'nama' => $this->dataset['nama'],
            'group_tk_pend_nm' => $this->dataset['group_tk_pend_nm'],
            'maxkgolru' => $this->dataset['maxkgolru'] ?? null,
            'ref_simpeg' => $this->dataset['ref_simpeg'] ?? null,
        ];

        $id = $this->sid;
        $validator = Validator::make($retData, [
            //'id' => 'required|unique:master_tingkat_pendidikan',
            'nama' => [
                'required',
                Rule::unique('master_tingkat_pendidikan')->ignore($id),
            ],
            'group_tk_pend_nm' => [
                'required',
            ],
        ],[
            'nama.required' => 'Nama Tingkat Pendidikan tidak boleh kosong',
            'nama.unique' => 'Nama Tingkat Pendidikan Telah terdaftar',

            'group_tk_pend_nm.required' => 'Nama Group Tingkat Pendidikan tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterTingkatPendidikan::find($this->sid)->update($retData);

        return redirect('/tingkat_pendidikan')->with([
            'success'=> "Data Master Tingkat Pendidikan Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.tingkat-pendidikan.formulir', [
            'master_pangkat' => MasterPangkat::all(),
        ]);
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterTingkatPendidikan::find($this->sid);

            if($dataset){
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'group_tk_pend_nm' => $dataset->group_tk_pend_nm,
                    'maxkgolru' => $dataset->maxkgolru,
                    'ref_simpeg' => $dataset->ref_simpeg,
                ];
            }
        }
    }
}
