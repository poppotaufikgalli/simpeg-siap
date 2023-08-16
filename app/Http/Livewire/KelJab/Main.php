<?php

namespace App\Http\Livewire\KelJab;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterKelJab;
use App\Models\MasterJenisJabUmum;
use App\Models\MasterInstansi;
use App\Models\MasterRumpunJafung;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $jenis_jabatan_id;
    public $rumpun_jabatan_id;
    public $pembina_id;

    public function render()
    {
        $retData = MasterKelJab::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }

            if($this->jenis_jabatan_id != ""){
                $query->where('jenis_jabatan_id', '=', $this->jenis_jabatan_id);
            }

            if($this->rumpun_jabatan_id != ""){
                $query->where('rumpun_jabatan_id', '=', $this->rumpun_jabatan_id);
            }

            if($this->pembina_id != ""){
                $query->where('pembina_id', '=', $this->pembina_id);
            }

        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.kel-jab.main', [
            'master_kel_jab' => $retData,
            'master_jenis_jabatan_umum' => MasterJenisJabUmum::all(),
            'master_instansi' => MasterInstansi::all(),
            'master_rumpun_jabfung' => MasterRumpunJafung::all()
        ]);
    }
}
