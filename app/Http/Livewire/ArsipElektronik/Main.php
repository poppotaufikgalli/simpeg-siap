<?php

namespace App\Http\Livewire\ArsipElektronik;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\VPegawai;
use App\Models\MasterJenisProfesi;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $nip;
    public $namapeg;
    
    public function render()
    {
        $retData = VPegawai::where(function($query){
            if($this->nip != ""){
                $query->where('nip', 'like', '%'.$this->nip.'%');
            }

            if($this->namapeg != ""){
                $query->where('namapeg', 'like', '%'.$this->namapeg.'%');
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.arsip-elektronik.main', [
            'master_pegawai' => $retData,
        ]);
    }
}
