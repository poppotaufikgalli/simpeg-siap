<?php

namespace App\Http\Livewire\MasterJft;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterKelJab;
use App\Models\MasterJFT;
use App\Models\MasterJenjangJafung;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $cepat_kode;
    public $bup_usia;
    public $ref_simpeg;
    public $jenjang;
    public $status;
    public $kel_jabatan_id;

    public function render()
    {
        $retData = MasterJFT::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }

            if($this->cepat_kode != ""){
                $query->where('cepat_kode', 'like', '%'.$this->cepat_kode.'%');
            }

            if($this->bup_usia != ""){
                $query->where('bup_usia', 'LIKE', '%'.$this->bup_usia.'%');
            }

            if($this->ref_simpeg != ""){
                $query->where('ref_simpeg', '=', $this->ref_simpeg);
            }

            if($this->jenjang != ""){
                $query->where('jenjang', 'LIKE', '%'.$this->jenjang.'%');
            }

            if($this->status != ""){
                $query->where('status', '=', $this->status);
            }

            if($this->kel_jabatan_id != ""){
                $query->where('kel_jabatan_id', '=', $this->kel_jabatan_id);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.master-jft.main', [
            'master_jft' => $retData,
            'master_kelompok_jabatan' => MasterKelJab::all(),
            'master_jenjang_jabfung' => MasterJenjangJafung::all(),
        ]);
    }
}
