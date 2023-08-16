<?php

namespace App\Http\Livewire\MasterJabatan;

use Livewire\Component;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterOPD;
use App\Models\MasterJabatan;
use App\Models\MasterJenisJabatan;
use App\Models\MasterEselon;

use App\Models\MasterJabStr;
use App\Models\MasterJFU;
use App\Models\MasterJFT;
use App\Models\MasterNegara;

class Formulir extends Component
{
    public $next;
    public $method;
    public $sid;
    public $dataset;
    public $id_jabatan;
    public $selectEselon = false;

    public $lblStts = "Tidak Aktif";
    public $master_eselon;
    public $master_atasan;
    public $master_jabatan;
    public $kd_jab;

    public $jab_table_name;

    public function mount()
    {
        if($this->sid != ''){
            $dataset = MasterJabatan::find($this->sid);
            //dd($dataset);

            if($dataset){
                //$this->id_jabatan = $dataset->id_jabatan;
                $this->changeOPD($dataset->id_opd);
                $this->changeJnsJab($dataset->id_jenis_jabatan);
                $this->kd_jab = $dataset->ref_jabatan_id;

                $this->changeStts($dataset->status);

                $this->dataset = [
                    '_id' => $dataset->id,
                    'parent_id' => $dataset->parent_id,
                    'id_opd' => $dataset->id_opd,
                    'nama' => $dataset->nama,
                    'id_eselon' => $dataset->id_eselon,
                    'id_jenis_jabatan' => $dataset->id_jenis_jabatan,
                    //'id_jab' => $dataset->ref_jabatan_id,
                    'ref_jabatan_id' => $dataset->ref_jabatan_id,
                    'kelas_jabatan' => $dataset->kelas_jabatan,
                    'nilai_jabatan' => $dataset->nilai_jabatan,
                    'indeks_jabatan' => $dataset->indeks_jabatan,
                    'status' => $dataset->status,
                ];
            }
        }
    }

    public function store()
    {
        //dd($this->dataset);
        $retData = [
            'id' => $this->dataset['_id'],
            'parent_id' => $this->dataset['parent_id'] ?? 0,
            'id_opd' => $this->dataset['id_opd'],
            'nama' => $this->dataset['nama'],
            'id_jenis_jabatan' => $this->dataset['id_jenis_jabatan'],
            'id_eselon' => $this->dataset['id_jenis_jabatan'] == 1 ? $this->dataset['id_eselon'] : 99,
            'ref_jabatan_id' => $this->dataset['ref_jabatan_id'],
            'kelas_jabatan' => $this->dataset['kelas_jabatan'],
            'nilai_jabatan' => $this->dataset['nilai_jabatan'],
            'indeks_jabatan' => $this->dataset['indeks_jabatan'],
            'status' => $this->dataset['status'] == 'on' ? 1 : 0,
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_formasi_jabatan',
            'parent_id' => 'required',
            'id_opd' => 'required',
            'nama' => 'required|unique:master_formasi_jabatan',
            //'id_eselon' => 'required|unique:master_formasi_jabatan',
            'id_jenis_jabatan' => 'required',
            //'kelas_jabatan' => 'required|unique:master_formasi_jabatan',
            //'nilai_jabatan' => 'required|unique:master_formasi_jabatan',
            //'indeks_jabatan' => 'required|unique:master_formasi_jabatan',
            //'status' => 'required|unique:master_formasi_jabatan',
        ],[
            'id.required' => 'Id Jabatan tidak boleh kosong',
            'id.unique' => 'Id Jabatan Telah terdaftar',

            'parent_id.required' => 'Pejabat Atasan tidak boleh kosong',
            'parent_id.unique' => 'Pejabat Atasan Telah terdaftar',

            'id_opd.required' => 'ID OPD tidak boleh kosong',
            //'id_opd.unique' => 'ID OPD Telah terdaftar',

            'nama.required' => 'Nama Jabatan tidak boleh kosong',
            'nama.unique' => 'Nama Jabatan Telah terdaftar',

            //'id_eselon.required' => 'Kode Jurusan Pendidikan tidak boleh kosong',
            //'id_eselon.unique' => 'Kode Jurusan Pendidikan Telah terdaftar',

            'id_jenis_jabatan.required' => 'Id Jenis Jabatan tidak boleh kosong',
            //'id_jenis_jabatan.unique' => 'Id Jenis Jabatan Telah terdaftar',

            //'kelas_jabatan.required' => 'Nama Jurusan Pendidikan tidak boleh kosong',
            //'kelas_jabatan.unique' => 'Nama Jurusan Pendidikan Telah terdaftar',

            //'nilai_jabatan.required' => 'Nilai Jabatan tidak boleh kosong',
            //'nilai_jabatan.unique' => 'Nilai Telah terdaftar',

            //'indeks_jabatan.required' => 'Nama Jurusan Pendidikan tidak boleh kosong',
            //'indeks_jabatan.unique' => 'Nama Jurusan Pendidikan Telah terdaftar',

            //'status.required' => 'Kode Jurusan Pendidikan tidak boleh kosong',
            //'status.unique' => 'Kode Jurusan Pendidikan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterJabatan::create($retData);

        return redirect('/master_jabatan')->with([
            'success'=> "Data Master Jabatan Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        //dd($this->dataset);
        $retData = [
            //'id' => $this->id_jabatan,
            'parent_id' => $this->dataset['parent_id'] ?? 0,
            'id_opd' => $this->dataset['id_opd'],
            'nama' => $this->dataset['nama'],
            'id_jenis_jabatan' => $this->dataset['id_jenis_jabatan'],
            'id_eselon' => $this->dataset['id_jenis_jabatan'] == 1 ? $this->dataset['id_eselon'] : 99,
            'ref_jabatan_id' => $this->dataset['ref_jabatan_id'],
            'kelas_jabatan' => $this->dataset['kelas_jabatan'],
            'nilai_jabatan' => $this->dataset['nilai_jabatan'],
            'indeks_jabatan' => $this->dataset['indeks_jabatan'],
            'status' => $this->dataset['status'] == true || $this->dataset['status'] == 'on' ? 1 : 0,
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            /*'id' => [
                'required',
                Rule::unique('master_formasi_jabatan')->ignore($this->sid, 'id_jabatan')
            ],*/
            'nama' => [
                'required',
                Rule::unique('master_formasi_jabatan')->ignore($id)
            ],
        ],[
            /*'id_jabatan.required' => 'Id Jabatan tidak boleh kosong',
            'id_jabatan.unique' => 'Id Jabatan Telah terdaftar',*/

            'nama.required' => 'Nama Jabatan tidak boleh kosong',
            'nama.unique' => 'Nama Jabatan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterJabatan::find($this->sid)->update($retData);

        return redirect('/master_jabatan')->with([
            'success'=> "Data Master Jabatan Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.master-jabatan.formulir', [
            'master_opd' => MasterOPD::where('status', '=', 1)->where('sfilter', '=', 1)->get(),
            'master_jenis_jabatan' => MasterJenisJabatan::where('status', '=', 1)->get(),
        ]);
    }

    public function changeOPD($selId)
    {
        if($selId != ""){
            $selOpd = MasterOPD::where('id', '=', $selId)->select('id', 'parent_opd')->first();
            $this->master_atasan = MasterJabatan::where('status', '=', 1)->whereIn('id_jenis_jabatan', [1,5])
                ->where(function($query) use($selOpd){
                    $query->whereIn('id_opd',  [$selOpd->id, $selOpd->parent_opd]);
                })->get();
            //]]dd($this->master_atasan);
            $this->dataset["_id"] = $selId;
        }
    }

    public function changeStts($selId)
    {
        $this->lblStts = $selId ? 'Aktif' : 'Tidak Aktif';
    }

    public function changeJnsJab($selId)
    {
        //dd($this->jab_table_name);
        $this->kd_jab = "";
        $this->master_eselon = MasterEselon::where('id_jenis_jabatan', '=', $selId)->where('status', '=', 1)->get();

        switch($selId){
            case 1 :
                $this->selectEselon = true;
                $this->master_jabatan = MasterJabStr::all();
                break;
            case 2 :
                $this->selectEselon = false;
                $this->master_jabatan = MasterJFT::all();
                break;
            case 4 :
                $this->selectEselon = false;
                $this->master_jabatan = MasterJFU::all();
                break;
            case 5 :
                $this->selectEselon = false;
                $this->master_jabatan = MasterNegara::all();
                break;
            default:
                $this->selectEselon = false;
        }
    }

    public function changeEselon($selId)
    {

    }
}
