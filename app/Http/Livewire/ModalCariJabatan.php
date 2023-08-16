<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\MasterJabStr;
use App\Models\MasterJFU;
use App\Models\MasterJFT;
use App\Models\MasterNegara;

class ModalCariJabatan extends Component
{
    public $dataset;
    
    protected $listeners = ['openModal'];

    public function render()
    {
        return view('livewire.modal-cari-jabatan');
    }

    public function openModal($id_jenis_jabatan){
        //dd($id_jenis_jabatan);
        switch($id_jenis_jabatan){
            case 1 :
                $this->selectEselon = true;
                $this->dataset = MasterJabStr::all();
                break;
            case 2 :
                $this->selectEselon = false;
                $this->dataset = MasterJFT::all();
                break;
            case 4 :
                $this->selectEselon = false;
                $this->dataset = MasterJFU::all();
                break;
            case 5 :
                $this->selectEselon = false;
                $this->dataset = MasterNegara::all();
                break;
            default:
                $this->selectEselon = false;
        }
        $this->dispatchBrowserEvent('open-modal');
    }
}
