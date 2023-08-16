<?php

namespace App\Http\Livewire\JenisKompetensi;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisKompetensi;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $nama_id;

    public function render()
    {
        $retData = MasterJenisKompetensi::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }

            if($this->nama_id != ""){
                $query->where('nama_id', 'like', '%'.$this->nama_id.'%');
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();
        return view('livewire.jenis-kompetensi.main', [
            'master_jenis_kompetensi' => $retData,
        ]);
    }
}
