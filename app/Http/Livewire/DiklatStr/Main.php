<?php

namespace App\Http\Livewire\DiklatStr;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterDiklatStr;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $ref_simpeg;
    
    public function render()
    {
        $retData = MasterDiklatStr::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->ref_simpeg != ""){
                $query->where('ref_simpeg', 'like', '%'.$this->ref_simpeg.'%');
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.diklat-str.main', [
            'master_diklat_str' => $retData,
        ]);
    }
}
