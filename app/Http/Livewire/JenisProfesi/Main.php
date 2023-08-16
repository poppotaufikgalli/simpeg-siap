<?php

namespace App\Http\Livewire\JenisProfesi;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisProfesi;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    
    public function render()
    {
        $retData = MasterJenisProfesi::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.jenis-profesi.main', [
            'master_jenis_profesi' => $retData,
        ]);
    }
}
