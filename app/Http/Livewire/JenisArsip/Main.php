<?php

namespace App\Http\Livewire\JenisArsip;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisArsip;
use App\Models\MasterGroupArsip;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $group_arsip_id;
    public $jnsdok;
    public $riw;

    public function render()
    {
        $retData = MasterJenisArsip::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->jnsdok != ""){
                $query->where('jnsdok', 'like', '%'.$this->jnsdok.'%');
            }

            if($this->group_arsip_id != ""){
                $query->where('group_arsip_id', '=', $this->group_arsip_id);
            }

            if($this->riw != ""){
                $query->where('riw', '=', $this->riw);
            }
        })->orderBy('group_arsip_id')->orderBy('id')->Paginate(20)->withQueryString();

        $this->resetPage();


        return view('livewire.jenis-arsip.main', [
            'master_jenis_arsip' => $retData,
            'master_group_arsip' => MasterGroupArsip::all(),
        ]);
    }
}
