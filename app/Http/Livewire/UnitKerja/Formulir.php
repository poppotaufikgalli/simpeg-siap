<?php

namespace App\Http\Livewire\UnitKerja;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterOPD;
use App\Models\MasterEselon;
use App\Models\MasterJabatan;
use App\Models\MasterReferensiJabatan;

class Formulir extends Component
{
    public $method;
    public $next;
    public $sid;
    public $dataset;

    public $lblStts = "Tidak Aktif";
    public $lblSfilter = 'Tidak';
    public $lblParent= '';

    public function store()
    {
        $parent_opd = $this->dataset['parent_opd'] ?? 1;

        $retData = [
            'id' => $this->dataset['_id'],
            'parent_opd' => $parent_opd,
            'status' => isset($this->dataset['status']) && $this->dataset['status'] == 'on' ? 1 : 0, 
            'nama' => $this->dataset['nama'],
            'disingkat' => $this->dataset['disingkat'] ?? '',
            'id_eselon' => $this->dataset['id_eselon'] ?? 21,
            'sfilter' => isset($this->dataset['sfilter']) && $this->dataset['sfilter']  == 'on' ? 1 : 0,
            'alamat' => $this->dataset['alamat'] ?? '',
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_opd',
            'nama' => 'required|unique:master_opd',
            'disingkat' => 'unique:master_opd',
        ],[
            'id.required' => 'Kode Unit Kerja tidak boleh kosong',
            'id.unique' => 'Kode Unit Kerja Telah terdaftar',

            'nama.required' => 'Nama Unit Kerja tidak boleh kosong',
            'nama.unique' => 'Nama Unit Kerja Telah terdaftar',

            'disingkat.unique' => 'Singkatan Unit Kerja Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterOPD::create($retData);
        
        if($this->dataset['nama_jabatan_kepala'] != ""){
            MasterJabatan::updateOrCreate( ['id' => $this->sid], [
                'id' => $retData['id'],
                'parent_id' => $retData['parent_opd'],
                'id_opd' => $retData['id'],
                'nama' => $this->dataset['nama_jabatan_kepala'],
                'id_eselon' => $retData['id_eselon'],
                'id_jenis_jabatan' => 1,
                'status' => 1,
            ]);
        }
        
        return redirect('/unit_kerja')->with([
            'success'=> "Data Master Unit Kerja Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'status' => ($this->dataset['status'] == 'on' ||  $this->dataset['status'] == 1) ? 1 : 0, 
            'disingkat' => $this->dataset['disingkat'],
            'id_eselon' => $this->dataset['id_eselon'],
            'sfilter' => ($this->dataset['sfilter'] == 'on' ||  $this->dataset['sfilter'] == 1) ? 1 : 0, 
            'alamat' => $this->dataset['alamat'],
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => ['required', Rule::unique('master_opd')->ignore($id)],
            'disingkat' => [Rule::unique('master_opd')->ignore($id)],
        ],[
            'nama.required' => 'Nama Jenis Personel tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Personel Telah terdaftar',

            'disingkat.unique' => 'Singkatan Unit Kerja Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        
        MasterOPD::find($this->sid)->update($retData);

        if($this->dataset['nama_jabatan_kepala'] != ""){
            $kepala = MasterReferensiJabatan::where('nama', '=', $this->dataset['nama_jabatan_kepala'])->first();
            if($kepala == null){
                $result = MasterReferensiJabatan::create([
                    'id' => $this->sid,
                    'nama' => $this->dataset['nama_jabatan_kepala'],
                    'jenis_jabatan_id' => $this->dataset['id_eselon'] == 99 ? 4 : 1,
                ]);
                //dd($result);
            }
            //dd($kepala);
            MasterJabatan::updateOrCreate( ['id' => $this->sid], [
                'id' => $this->sid,
                'parent_id' => $this->dataset['parent_opd'] ?? 1,
                'id_opd' => $this->sid,
                'nama' => $this->dataset['nama_jabatan_kepala'],
                'id_eselon' => $retData['id_eselon'],
                'ref_jabatan_id' => $this->sid,
                'id_jenis_jabatan' => 1,
                'status' => 1,
            ]);
        }

        return redirect('/unit_kerja')->with([
            'success'=> "Data Master Unit Kerja Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.unit-kerja.formulir', [
            'master_eselon' => MasterEselon::where('id_jenis_jabatan', '=', 1)->where('status', '=', 1)->get(),
            //'master_referensi_jabatan' => MasterReferensiJabatan::all(),
            'opd_utama' => MasterOPD::where(["sfilter" => 1])->get(),
        ]);
    }

    public function changeStts($selId){
        $this->lblStts = $selId ? 'Aktif' : 'Tidak Aktif';
    }

    public function changeSfilter($selId){
        $this->lblSfilter = $selId ? 'Ya' : 'Tidak';
    }

    public function changeParent($selId){
        if($this->sid == ""){
            $this->dataset['_id'] = $selId;
        }
    }

    public function mount()
    {
        if($this->sid !=  ""){
            $dataset = MasterOPD::find($this->sid);
            //dd($dataset);
        
            if($dataset) {
                $this->dataset = [
                    '_id' => $dataset->id,
                    'parent_opd' => $dataset->parent_opd,
                    'nama' => $dataset->nama,
                    'disingkat' => $dataset->disingkat,
                    'status' => $dataset->status,
                    'sfilter' => $dataset->sfilter,
                    'alamat' => $dataset->alamat,
                    'id_eselon' => $dataset->id_eselon,
                ];
                $this->changeStts($dataset->status);
                $this->changeParent($dataset->parent_opd);
                $this->changeSfilter($dataset->sfilter);
            }    

            $kepala = MasterJabatan::find($this->sid);
            if($kepala){
                //dd($kepala);
                $this->dataset['nama_jabatan_kepala'] = $kepala->nama;
            }
        }else{
            $this->dataset["_id"] = '1';
        }
        
    }
}
