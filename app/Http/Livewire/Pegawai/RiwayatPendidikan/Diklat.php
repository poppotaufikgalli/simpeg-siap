<?php

namespace App\Http\Livewire\Pegawai\RiwayatPendidikan;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatDiklat;
use App\Models\MasterJenisDiklat;
use App\Models\MasterDiklat;
use App\Models\MasterPejabat;
use App\Models\MasterJenisArsip;

class Diklat extends Component
{
    public $sid;
    public $jdiklat;
    public $subPage = 'list';
    public $lblStts = "Tidak";

    public $next;
    public $method;
    public $dataset = [];
    public $arsip = [];

    public $tmulai;
    public $master_jenis_arsip = [];

    //public $master_diklat = [];

    protected $listeners = ["tambah", "tutup", "edit", "delete", "callModal"];

    public function callModal($tmulai, $group_name, $jenis){
        $hash = preg_replace("![^a-z0-9]+!i", "-", strtolower($group_name));
        //$type, $name, $hash, $table, $key
        $this->emitTo('modal-upload-arsip-personel', 'openModalPersonel', $jenis, $tmulai, $hash, 'master_riwayat_diklat', [
            'nip' => $this->sid,
            'tmulai' => $tmulai,
            'jdiklat' => $this->jdiklat,
        ]);
    }

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['jdiklat'] = $this->jdiklat;

        $validator = Validator::make($data, [
            'tmulai' => 'required|unique:master_riwayat_diklat',
            'tmulai' => [
                'required',
                Rule::unique('master_riwayat_diklat')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmulai', '=', $data['tmulai'])
                        ->where('jdiklat', '=', $this->jdiklat);
                }),
            ],
        ],[
            'tmulai.required' => 'Tanggal Mulai Diklat tidak boleh kosong',
            'tmulai.unique' => 'Tanggal Mulai Diklat telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        if(isset($data['akhir']) && $data['akhir'] == true){
            MasterRiwayatDiklat::where('nip', '=', $this->sid)->where('jdiklat', '=', $this->jdiklat)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);    
        }

        MasterRiwayatDiklat::create($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Diklat berhasil ditambahkan");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['jdiklat'] = $this->jdiklat;

        $validator = Validator::make($data, [
            'tmulai' => [
                'required',
                Rule::unique('master_riwayat_diklat')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmulai', '=', $data['tmulai'])
                        ->where('jdiklat', '=', $this->jdiklat);
                })->ignore($this->sid, 'nip')->ignore($this->tmulai, 'tmulai')->ignore($this->jdiklat, 'jdiklat'),
            ],
        ],[
            'tmulai.required' => 'Tanggal Mulai Diklat tidak boleh kosong',
            'tmulai.unique' => 'Tanggal Mulai Diklat telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        if(isset($data['akhir']) && $data['akhir'] == true){
            MasterRiwayatDiklat::where('nip', '=', $this->sid)->where('jdiklat', '=', $this->jdiklat)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);    
        }

        MasterRiwayatDiklat::where('nip', '=', $this->sid)->where('tmulai', '=', $this->tmulai)->where('jdiklat', '=', $this->jdiklat)->update($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Diklat berhasil diubah");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }
    
    public function render()
    {
        $retData = MasterRiwayatDiklat::where('nip', '=', $this->sid)->where('jdiklat', '=', $this->jdiklat)->get();

        return view('livewire.pegawai.riwayat-pendidikan.diklat', [
            'master_riwayat_diklat' => $retData,
            'master_jenis_diklat' => MasterJenisDiklat::where('id', '=', $this->jdiklat)->first(),
            'master_diklat' => MasterDiklat::where('jdiklat', '=', $this->jdiklat)->get(),
            //'master_tingkat_pendidikan' => MasterTingkatPendidikan::all(),
            //'master_pendidikan' => MasterPendidikan::where('status', '=', 1)->get(),
            //'master_pejabat' => MasterPejabat::all()
            //'master_pangkat' => MasterPangkat::all(),
        ]);
    }

    public function changeStts($selId)
    {
        $this->lblStts = $selId == 1 ? "Ya" : "Tidak";
    }

    public function mount(){
        $this->dataset['nip'] = $this->sid;
    }

    public function setndiklat($selId)
    {
        $dt = MasterDiklat::where('jdiklat', '=', $this->jdiklat)->where('id', "=", $selId)->first();
        $this->dataset['ndiklat'] = $dt->nama;
    }

    public function tambah()
    {
        $this->subPage = 'formulir';
        $this->next = "store";
        //$this->dataset['negara'] = "INDONESIA";
    }

    public function tutup()
    {
        $this->subPage = 'list';
        $this->dataset = [];
        $this->dataset['nip'] = $this->sid;

        //$this->dataset['negara'] = "INDONESIA";
    }

    public function edit($value)
    {
        //dd($value);

        $this->subPage = 'formulir';
        $this->next = "update";

        $dataset = MasterRiwayatDiklat::where('nip', '=', $this->sid)->where('tmulai', '=', $value['tmulai'])->where('jdiklat', '=', $this->jdiklat)->first();

        if($dataset){
            $this->tmulai = $value['tmulai'];
            $this->changeStts($dataset['akhir']);
            $this->dataset = $dataset->toArray();
            $this->getMasterArsip('diklat_'.$dataset['jdiklat'].'_'.$dataset['tmulai'], "Diklat : ".$dataset['ndiklat']);
        }else{
            $this->dataset['nip'] = $this->sid;
        }

        //$this->dataset['negara'] = "INDONESIA";
    }

    public function getMasterArsip($jns, $nama)
    {
        $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'diklat')->get();
        if($master_jenis_arsip){
            foreach ($master_jenis_arsip as $key => $value) {
                $value->jnsdok = $jns;
                $value->nama = $nama;
            }
            $this->master_jenis_arsip = $master_jenis_arsip;
        }
    }

    public function delete($value)
    {
        $del = MasterRiwayatDiklat::where('nip', '=', $this->sid)->where('tmulai', '=', $value['tmulai'])->where('jdiklat', '=', $this->jdiklat)->delete();
        //dd($del);
        //$del->delete();      
        
        $this->dispatchBrowserEvent('informations', "Data Riwayat Diklat berhasil dihapus");  
    }
}
