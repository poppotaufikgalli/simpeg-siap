<?php

namespace App\Http\Livewire\Agama;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterAgama;

class Main extends Component
{
    use WithPagination;

    public $_id;
    public $nama;

    public function render()
    {
        $retData = MasterAgama::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'like', '%'.$this->nama.'%');
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.agama.main', [
            'master_agama' => $retData,
        ]);
    }
}
