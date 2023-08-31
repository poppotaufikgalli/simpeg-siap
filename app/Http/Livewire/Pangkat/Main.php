<?php

namespace App\Http\Livewire\Pangkat;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterPangkat;
use App\Models\MasterKorps;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $id_jenis_personel = 0;
    public $nama;
    public $nama_pangkat;
    public $id_korps;
    public $ref_simpeg;
    public $pajak;

    public function render()
    {
        $retData = MasterPangkat::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->nama_pangkat != ""){
                $query->where('nama_pangkat', 'like', '%'.$this->nama_pangkat.'%');
            }

            if($this->ref_simpeg != ""){
                $query->where('ref_simpeg', 'like', '%'.$this->ref_simpeg.'%');
            }
            
            if($this->pajak != ""){
                $query->where('pajak', 'like', '%'.$this->pajak.'%');
            }

            if($this->id_jenis_personel != ""){
                $query->where('id_jenis_personel', '=', $this->id_jenis_personel);
            }

            if($this->id_korps != ""){
                $query->where('id_korps', '=', $this->id_korps);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.pangkat.main', [
            'master_pangkat' => $retData,
            'master_korps' => MasterKorps::where('status', '=', 1)->get(),
        ]);
    }
}
