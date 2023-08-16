<?php

namespace App\Http\Livewire\MasterJabatan;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJabatan;
use App\Models\MasterJenisJabatan;
use App\Models\MasterEselon;
use App\Models\MasterOPD;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $id_jenis_jabatan;
    public $id_eselon;
    public $kelas_jabatan;
    public $status_jabatan;

    public $id_opd;
    public $route;


    public function render()
    {
        $retData = MasterJabatan::where(function($query){
            if($this->id_opd != ""){
                $query->where('id_opd', '=', $this->id_opd);
            }
            if($this->_id != ""){
                $query->where('id', '=', $this->_id);
            }
            
            if($this->id_eselon != ""){
                $query->where('id_eselon', 'LIKE', '%'.$this->id_eselon.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }

            if($this->id_jenis_jabatan != ""){
                $query->where('id_jenis_jabatan', '=', $this->id_jenis_jabatan);
            }

            if($this->kelas_jabatan != ""){
                $query->where('kelas_jabatan', '=', $this->kelas_jabatan);
            }

            if($this->status_jabatan != ''){
                $query->where('status_jabatan', '=', $this->status_jabatan);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.master-jabatan.main', [
            'master_jabatan' => $retData,
            'master_jenis_jabatan' => MasterJenisJabatan::where('status', '=', 1)->get(),
            'master_eselon' => MasterEselon::where('status', '=', 1)->get(),
            'master_opd' => MasterOPD::where('status', '=', 1)->get(),
        ]);
    }
}
