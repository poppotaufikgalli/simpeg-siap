<?php

namespace App\Http\Livewire\TingkatPendidikan;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterTingkatPendidikan;
use App\Models\MasterPangkat;

class Main extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $group_tk_pend_nm;
    public $maxkgolru;

    public function render()
    {
        $retData = MasterTingkatPendidikan::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->group_tk_pend_nm != ""){
                $query->where('group_tk_pend_nm', 'like', '%'.$this->group_tk_pend_nm.'%');
            }

            if($this->maxkgolru != ""){
                $query->where('maxkgolru', '=', $this->maxkgolru);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.tingkat-pendidikan.main', [
            'master_tingkat_pendidikan' => $retData,
            'master_pangkat' => MasterPangkat::all(),
        ]);
    }
}
