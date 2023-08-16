<?php

namespace App\Http\Livewire\GroupArsip;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterGroupArsip;

class Main extends Component
{
    use WithPagination;

    public $next;
    public $method;
    public $route;

    public $_id;
    public $nama;

    public function render()
    {
        $retData = MasterGroupArsip::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }
        })->Paginate(20)->withQueryString();

        return view('livewire.group-arsip.main', [
            'master_group_arsip' => $retData,
        ]);
    }
}
