<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\MasterJenisJabatan;

class SideJnsJab extends Component
{
    public $selRoute;
    
    public function render()
    {
        return view('livewire.side-jns-jab', [
            'ref_jabatan' => MasterJenisJabatan::where('status', '=', 1)->get(),
        ]);
    }
}
