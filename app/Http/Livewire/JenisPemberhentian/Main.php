<?php

namespace App\Http\Livewire\JenisPemberhentian;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisPemberhentian;

class Main extends Component
{
    use WithPagination;

    public $_id;
    public $nama;

    public function render()
    {
        $retData = MasterJenisPemberhentian::where(function($query){
             if($this->_id != ""){
                $query->where('id', '=', $this->_id);
            }

            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.jenis-pemberhentian.main', [
            'master_jenis_pemberhentian' => $retData,
        ]);
    }
}
