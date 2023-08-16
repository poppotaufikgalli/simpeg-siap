<?php

namespace App\Http\Livewire\Pegawai\DataInduk;

use Livewire\Component;

//use App\Models\MasterInstansi;
use App\Models\MasterJabatan;
use App\Models\MasterOPD;
use App\Models\MasterPejabat;
use App\Models\MasterJenisJabatan;
use App\Models\MasterEselon;
use App\Models\MasterRiwayatJabatan;
use App\Models\MasterJenisArsip;

class Jabatan extends Component
{
    public $sid;
    public $next;
    public $method;
    public $dataset;
    public $jnsdok;
    public $arsip = [];
    public $nama;

    public $master_sub_opd;
    public $master_eselon;
    public $master_jabatan;
    public $akhir = 1;
    //public $master_jenis_jabatan;

    public function render()
    {
        if($this->jnsdok){
            $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'jabatan')->get();
            foreach ($master_jenis_arsip as $key => $value) {
                $value->jnsdok = $this->jnsdok;
                $value->nama = $this->nama;
            }
        }else{
            $master_jenis_arsip = [];
        }

        return view('livewire.pegawai.data-induk.jabatan', [
            'master_opd' => MasterOPD::where('sfilter', '=', 1)->where('status', '=', 1)->get(),
            'master_jenis_jabatan' => MasterJenisJabatan::where('status', '=', 1)->get(),
            'master_pejabat' => MasterPejabat::all(),
            'master_jenis_arsip' => $master_jenis_arsip,
            //'master_instansi' => MasterInstansi::all(),
        ]);
    }

    public function searchJabatan()
    {
        //dd($this->dataset);
        $retData = MasterJabatan::where(function($query){
            if(isset($this->dataset['id_opd']) && $this->dataset['id_opd'] != ""){
                $query->where('id_opd', '=', $this->dataset['id_opd']);
            }

            if(isset($this->dataset['jnsjab']) && $this->dataset['jnsjab'] != ""){
                $query->where('id_jenis_jabatan', '=', $this->dataset['jnsjab']);
            }

            if(isset($this->dataset['keselon']) &&$this->dataset['keselon'] != ""){
                $query->where('id_eselon', '=', $this->dataset['keselon']);
            }
        })->get();
        $this->master_jabatan = $retData;
        
    }

    public function changeJnsJab($selId){
        $this->dataset['keselon'] = "";
        $master_eselon = MasterEselon::where('status', '=', 1)->where('id_jenis_jabatan', '=', $selId)->get();  
        if(count($master_eselon) > 0){
            $this->master_eselon = $master_eselon;    
        }else{
            $this->master_eselon = [];    
        }
        
        $this->searchJabatan(); 
    }

    public function checkJabatan($selId)
    {
        $retData = MasterJabatan::find($selId);
        //dd($retData);
        $this->dataset['id_opd'] = $retData['id_opd'];
        $this->dataset['jnsjab'] = $retData['id_jenis_jabatan'];
        $this->changeJnsJab($retData['id_jenis_jabatan']);
        $this->dataset['keselon'] = $retData['id_eselon'];
        $this->dataset['njab'] = $retData['nama'];
        $this->dataset['sjab'] = $retData['id'];
    }

    public function mount()
    {
        //$this->master_eselon = MasterEselon::where('status', '=', 1)->get();
        $this->dataset['nip'] = $this->sid;
        if($this->sid != ""){
            $dataset = MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('akhir', '=', 1)->first();
            if($dataset){
                //$this->changeJnsJab($dataset->id_jenis_jabatan);
                $this->jnsdok = "jabatan".date('dmY', strtotime($dataset->tmtjab));
                $this->nama = $dataset->njab;
                $this->dataset = $dataset->toArray();
                $this->method = 'edit';
                $this->checkJabatan($dataset->kjab);
            }else{
                $this->method = 'update';
            }
        }else{
            //$this->dataset[]
        }
    }

    public function submit()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['akhir'] = $this->akhir;

        MasterRiwayatJabatan::where('nip', '=', $this->sid)->update([
            'akhir' => 0,
        ]);

        $exists = MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('tmtjab', '=', $this->dataset['tmtjab'])->first();
        if($exists){
            MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('tmtjab', '=', $this->dataset['tmtjab'])->update($data);
            $this->dispatchBrowserEvent('informations', "Data Jabatan Terakhir berhasil diubah");    
        }else{
            MasterRiwayatJabatan::create($data);
            $this->dispatchBrowserEvent('informations', "Data Jabatan Terakhir berhasil ditambahkan");    
        }
    }
}
