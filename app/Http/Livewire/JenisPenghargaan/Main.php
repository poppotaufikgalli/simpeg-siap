<?php

namespace App\Http\Livewire\JenisPenghargaan;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisPenghargaan;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $ref_simpeg;

    public function render()
    {
        $retData = MasterJenisPenghargaan::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->ref_simpeg != ""){
                $query->where('ref_bkn', 'LIKE', '%'.$this->ref_simpeg.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }
        })->orderByRaw('CONVERT(id, SIGNED) asc')->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.jenis-penghargaan.main', [
            'master_jenis_penghargaan' => $retData, 
        ]);
    }
}
