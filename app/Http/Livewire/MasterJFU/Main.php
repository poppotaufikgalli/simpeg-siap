<?php

namespace App\Http\Livewire\MasterJfu;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJabatan;
use App\Models\MasterJenisJabatan;
use App\Models\MasterOPD;
use App\Models\MasterJFU;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $cepat_kode;
    public $status;

    public function render()
    {
        $retData = MasterJFU::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }

            if($this->cepat_kode != ""){
                $query->where('cepat_kode', 'like', '%'.$this->cepat_kode.'%');
            }

            if($this->status != ""){
                $query->where('status', '=', $this->status);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.master-jfu.main', [
            'master_jfu' => $retData,
        ]);
    }
}
