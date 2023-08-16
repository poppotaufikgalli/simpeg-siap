<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Akses;

class Pengguna extends Component
{
    public function render()
    {
        $data['data'] = Akses::simplePaginate(20);
        return view('livewire.pengguna', $data);
    }
}
