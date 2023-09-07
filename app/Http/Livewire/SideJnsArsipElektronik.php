<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MasterJenisPersonel;

class SideJnsArsipElektronik extends Component
{
    public $readyToLoad = false;

    public function loadData(){
          $this->readyToLoad = true; 
    }

    public function render()
    {
        return view('livewire.side-jns-arsip-elektronik', [
            'master_jenis_personel' => $this->readyToLoad ? MasterJenisPersonel::where('stts', '=', 1)->get() : [],
        ]);
    }
}
