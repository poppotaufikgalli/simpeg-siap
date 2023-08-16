<?php

namespace App\Http\Livewire\Eselon;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterEselon;
use App\Models\MasterJenisJabatan;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $jabatan_asn;
    public $id_jenis_jabatan;
    public $status = 1;


    public function render()
    {
        $retData = MasterEselon::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->id_jenis_jabatan != ""){
                $query->where('id_jenis_jabatan', '=', $this->id_jenis_jabatan);
            }

            if($this->jabatan_asn != ""){
                $query->where('jabatan_asn', 'like', '%'.$this->jabatan_asn.'%');
            }

            if($this->status != ""){
                $query->where('status', '=', $this->status);
            }
            
        })->Paginate(20)->withQueryString();

        $this->resetPage();
        return view('livewire.eselon.main', [
            'master_eselon' => $retData,
            'master_jenis_jabatan' => MasterJenisJabatan::where('status', '=', 1)->get(),
        ]);
    }
}
