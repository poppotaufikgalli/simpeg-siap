<?php

namespace App\Http\Livewire\JenisKawin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisKawin;

class Main extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $ref_simpeg;

    public function render()
    {
        $retData = MasterJenisKawin::where(function($query){
             if($this->_id != ""){
                $query->where('id', '=', $this->_id);
            }

            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }

            if($this->ref_simpeg != ""){
                $query->where('ref_simpeg', '=', $this->ref_simpeg);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.jenis-kawin.main', [
            'master_jenis_kawin' => $retData,
        ]);
    }
}
