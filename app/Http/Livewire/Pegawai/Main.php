<?php

namespace App\Http\Livewire\Pegawai;

use Livewire\Component;
use Livewire\WithPagination;

//use App\Models\VPeglistall;
use App\Models\VPegawai;
use App\Models\MasterOPD;
use App\Models\MasterEselon;
use App\Models\MasterJenisPegawai;
use App\Models\MasterJenisJabatan;
use App\Models\MasterStatusPegawai;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $kjpeg=[15, 20];
    public $filter;

    public $id_opd;
    public $id_sub_opd;
    public $namapeg;
    public $nip;
    public $id_eselon;
    public $id_jenis_jabatan;
    public $kstatus = [1,2,11];

    public $subopd = [];
    public $subeselon = [];
    public $showStatusJenis;

    public function render()
    {
        $retData = VPegawai::where(function($query){
            if($this->id_opd != ""){
                if($this->id_sub_opd != ""){
                    $query->where('id_opd', '=', $this->id_sub_opd)->orWhere('parent_opd', '=', $this->id_sub_opd);
                }else{
                    $query->where('id_opd', '=', $this->id_opd)->orWhere('parent_opd', '=', $this->id_opd);    
                }
            }

            if($this->kstatus != null && $this->kstatus != []){
                $query->whereIn('kstatus', $this->kstatus);
            }

            if($this->kjpeg != null && $this->kjpeg != []){
                $query->whereIn('kjpeg', $this->kjpeg);
            }

            if($this->namapeg != ""){
                $query->where('namapeg', 'like', '%'.$this->namapeg.'%');
            }

            if($this->nip != ""){
                $query->where('nip', 'like', $this->nip.'%');
            }

            if($this->id_jenis_jabatan != ""){
                $query->where('id_jenis_jabatan', '=', $this->id_jenis_jabatan);
            }

            if($this->id_eselon != ""){
                $query->where('id_eselon', '=', $this->id_eselon);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.pegawai.main', [
            'pegawai' => $retData,
            'master_opd' => MasterOPD::where(['sfilter' => 1])->get(),
            'master_jenis_pegawai' => MasterJenisPegawai::where('status', '=', 1)->get(),
            'master_jenis_jabatan' => MasterJenisJabatan::where('status', '=', 1)->get(),
            'master_status_pegawai' => MasterStatusPegawai::get(),
        ]);
    }

    public function changeParent($selId){
        //dd($selId);
        $this->subopd = MasterOPD::where('parent_opd', '=', $selId)->get();
    }

    public function changeJnsJab($selId){
        //dd($selId);
        if($selId == ""){
            $this->subeselon = [];
        }else{
            $this->subeselon = MasterEselon::where('id_jenis_jabatan', '=', $selId)->where('status', '=', 1)->get();
        }
    }
}
