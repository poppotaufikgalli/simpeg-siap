<?php

namespace App\Http\Livewire\JenisKp;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisKP;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $ref_simpeg;
    public $status=1;
    
    public function render()
    {
        $retData = MasterJenisKP::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->ref_simpeg != ""){
                $query->where('ref_simpeg', '=', $this->ref_simpeg);
            }

            if($this->status != ""){
                $query->where('status', '=', $this->status);
            }

        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.jenis-kp.main', [
            'master_jenis_kp' => $retData,
        ]);
    }
}
