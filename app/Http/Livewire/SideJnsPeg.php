<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\MasterJenisPegawai;

class SideJnsPeg extends Component
{
    public function render()
    {
        $data['data'] = MasterJenisPegawai::where('stts',1)->get();
        return view('livewire.side-jns-peg', $data);
    }
}
