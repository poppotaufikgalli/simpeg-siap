<?php

namespace App\Http\Livewire\RefJabatan;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterReferensiJabatan;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $jenis_jabatan_id;

    public $_id;
    public $nama;
    public $bup_usia;
    public $cepat_kode;
    public $ref_simpeg;
    
    public function render()
    {
        $retData = MasterReferensiJabatan::where('jenis_jabatan_id', '=', $this->jenis_jabatan_id)->where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->bup_usia != ""){
                $query->where('bup_usia', 'like', '%'.$this->bup_usia.'%');
            }

            if($this->cepat_kode != ""){
                $query->where('cepat_kode', 'like', '%'.$this->cepat_kode.'%');
            }

            if($this->ref_simpeg != ""){
                $query->where('ref_simpeg', 'like', '%'.$this->ref_simpeg.'%');
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.ref-jabatan.main', [
            'master_referensi_jabatan' => $retData,
        ]);
    }
}
