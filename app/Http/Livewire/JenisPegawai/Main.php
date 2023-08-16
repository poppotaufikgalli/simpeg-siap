<?php

namespace App\Http\Livewire\JenisPegawai;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisPegawai;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $status;
    public $_id;
    public $nama;
    public $ref_simpeg;

    public function render()
    {
        $retData = MasterJenisPegawai::where(function($query){
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

        return view('livewire.jenis-pegawai.main', [
            'master_jenis_pegawai' => $retData,
        ]);
    }
}
