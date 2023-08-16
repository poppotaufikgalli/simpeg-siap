<?php

namespace App\Http\Livewire\Instansi;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterInstansi;
use App\Models\MasterJenisInstansi;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $jenis;
    public $jenis_instansi_id;
    
    public function render()
    {
        $retData = MasterInstansi::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->jenis != ""){
                $query->where('jenis', '=', $this->jenis);
            }

            if($this->jenis_instansi_id != ""){
                $query->where('jenis_instansi_id', '=', $this->jenis_instansi_id);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.instansi.main', [
            'master_instansi' => $retData,
            'master_jenis_instansi' => MasterJenisInstansi::all(),
        ]);
    }
}
