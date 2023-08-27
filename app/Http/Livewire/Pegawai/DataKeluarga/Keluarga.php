<?php

namespace App\Http\Livewire\Pegawai\DataKeluarga;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

//use App\Models\MasterRiwayatDiklat;
//use App\Models\MasterJenisDiklat;

use App\Models\MasterRiwayatKeluarga;
use App\Models\MasterJenisKeluarga;
use App\Models\MasterPekerjaan;
//use App\Models\MasterPejabat;
use App\Models\MasterJenisArsip;

class Keluarga extends Component
{
    public $sid;
    public $jdiklat;
    public $jkeluarga;
    public $subPage = 'list';
    public $lblStts = "Tidak";

    public $next;
    public $method;
    public $dataset = [];
    public $arsip = [];

    public $tmulai;
    public $nama_kel;
    public $nama_jkeluarga;
    public $master_jenis_arsip = [];

    //public $master_diklat = [];

    protected $listeners = ["tambah", "tutup", "edit", "delete"];

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['jkeluarga'] = $this->jkeluarga;

        $validator = Validator::make($data, [
            'nama_kel' => [
                'required',
                Rule::unique('master_riwayat_keluarga')->where(function ($query) use($data) {
                    return $query->where('nip', $this->sid)
                        ->where('jkeluarga', $this->jkeluarga)
                        ->where('nama_kel', $data['nama_kel']);
                }),
            ],
        ],[
            'nama_kel.required' => 'Nama Anggota keluarga tidak boleh kosong',
            'nama_kel.unique' => 'Nama Anggota keluarga telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        if(isset($data['akhir']) && $data['akhir'] == true){
            MasterRiwayatKeluarga::where('nip', '=', $this->sid)->where('jkeluarga', '=', $this->jkeluarga)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);    
        }

        MasterRiwayatKeluarga::create($data);
        $this->dispatchBrowserEvent('informations', "Data Keluarga berhasil ditambahkan");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'nama_kel' => [
                'required',
                Rule::unique('master_riwayat_keluarga')->where(function ($query) use($data) {
                    return $query->where('nip', $this->sid)
                        ->where('jkeluarga', $this->jkeluarga)
                        ->where('nama_kel', $data['nama_kel']);
                })->ignore($this->sid,'nip')->ignore($this->jkeluarga,'jkeluarga')->ignore($this->nama_kel,'nama_kel'),
            ],
        ],[
            'nama_kel.required' => 'Nama Anggota keluarga tidak boleh kosong',
            'nama_kel.unique' => 'Nama Anggota keluarga telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        if(isset($data['akhir']) && $data['akhir'] == true){
            MasterRiwayatKeluarga::where('nip', '=', $this->sid)->where('jkeluarga', '=', $this->jkeluarga)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);    
        }

        MasterRiwayatKeluarga::where('nip', '=', $this->sid)->where('nama_kel', '=', $this->nama_kel)->where('jkeluarga', '=', $this->jkeluarga)->update($data);
        $this->dispatchBrowserEvent('informations', "Data Keluarga berhasil diubah");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }
    
    public function render()
    {
        $retData = MasterRiwayatKeluarga::where('nip', '=', $this->sid)->where('jkeluarga', '=', $this->jkeluarga)->get();
        //$master_jenis_keluarga = MasterJenisKeluarga::where('status', '=', 1)->first();
        //$this->nama_jkeluarga = $master_jenis_keluarga->nama;
        //dd($this->jkeluarga);
        return view('livewire.pegawai.data-keluarga.keluarga', [
            'master_riwayat_keluarga' => $retData,
            'master_jenis_keluarga' => MasterJenisKeluarga::where('id', '=', $this->jkeluarga)->first(),
            'master_pekerjaan' => MasterPekerjaan::where('status', '=', 1)->get(),
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

        $dataset = MasterRiwayatKeluarga::where('nip', '=', $this->sid)->where('nama_kel', '=', $value['nama_kel'])->where('jkeluarga', '=', $this->jkeluarga)->first();

        if($dataset){
            $this->nama_kel = $value['nama_kel'];
            //$this->changeStts($dataset['akhir']);
            $this->dataset = $dataset->toArray();
            $this->getMasterArsip('diklat_'.$dataset['jkeluarga'].'_'.$dataset['nama_kel'], "Keluarga : ".$dataset['nama']);
        }else{
            $this->dataset['nip'] = $this->sid;
        }

        //$this->dataset['negara'] = "INDONESIA";
    }

    public function getMasterArsip($jns, $nama)
    {
        $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'keluarga')->get();
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
        $del = MasterRiwayatKeluarga::where('nip', '=', $this->sid)->where('nama_kel', '=', $value['nama_kel'])->where('jkeluarga', '=', $this->jkeluarga)->delete();
        //dd($del);
        //$del->delete();      
        
        $this->dispatchBrowserEvent('informations', "Data Keluarga berhasil dihapus");  
    }
}
