<?php

namespace App\Http\Livewire\UnitKerja;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterOPD;
use App\Models\MasterEselon;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $status = 1;
    public $sfilter;
    public $id_eselon;

    public function render()
    {
        $retData = MasterOPD::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
                //$do_filter = true;
                //$query->where('id_opd', '=', $this->id_opd)->orWhere('parent_opd', '=', $this->id_opd);
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->id_eselon != ""){
                $query->where('id_eselon', '=', $this->id_eselon);
            }

            if($this->sfilter != ""){
                $query->where('sfilter', '=', $this->sfilter);
                //$do_filter = true;
            }

            if($this->status != ""){
                $query->where('status', '=', $this->status);
                //$do_filter = true;
            }
        })->paginate(20);

        $this->resetPage();

        return view('livewire.unit-kerja.main', [
            'master_opd' => $retData,
            'opd_utama' => MasterOPD::where(["sfilter" => 1])->get(),
            'master_eselon' => MasterEselon::where('id_jenis_jabatan', '=', 1)->get(),
        ]);
    }
}
