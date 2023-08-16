<?php

namespace App\Http\Livewire;

use App\Models\MasterOPD;
use App\Models\MasterEselon;
use App\Models\MasterJenisJabatan;
use App\Models\MasterJenisPegawai;
use App\Models\MasterStatusPegawai;
use Livewire\Component;

class MasterSubOpdSelect extends Component
{
    public $subdata;
    public $subdataeselon;
    public $filter;
    //public $id_opd;
    public $id_sub_opd;
    public $total;

    public function render()
    {
        $retData = [
            'data' => MasterOPD::where(['sfilter' => 1])->get(),
            //'subdataeselon' => MasterEselon::get(),
            'master_jenis_pegawai' => MasterJenisPegawai::where('stts', '=', 1)->get(),
            'master_jenis_jabatan' => MasterJenisJabatan::where('stts', '=', 1)->get(),
            'master_status_pegawai' => MasterStatusPegawai::get(),
        ];

        return view('livewire.master-sub-opd-select', $retData);
        
    }

    public function change($selId){
        //dd($selId);
        $this->subdata = MasterOPD::where('parent_opd', '=', $selId)->get();
    }

    public function changeJnsJab($selId){
        //dd($selId);
        $this->subdataeselon = MasterEselon::where('id_jenis_jabatan', '=', $selId)->get();
    }

    public function selectSubOpd(){
        if(isset($this->filter['id_opd']) && $this->filter['id_opd'] != ''){
            $this->change($this->filter['id_opd']);
        }

        if(isset($this->filter['id_jenis_jabatan']) && $this->filter['id_jenis_jabatan'] != ''){
            $this->changeJnsJab($this->filter['id_jenis_jabatan']);
        }else{
            $this->subdataeselon = MasterEselon::get();    
        }
    }
}
