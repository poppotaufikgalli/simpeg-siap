<?php

namespace App\Http\Livewire\JenisKursus;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisKursus;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $cepat_kode;
    public $ref_simpeg;
    
    public function render()
    {
        $retData = MasterJenisKursus::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->cepat_kode != ""){
                $query->where('cepat_kode', 'like', '%'.$this->cepat_kode.'%');
            }

            if($this->ref_simpeg != ""){
                $query->where('ref_simpeg', 'like', '%'.$this->ref_simpeg.'%');
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.jenis-kursus.main', [
            'master_jenis_kursus' => $retData,
        ]);
    }
}
