<?php

namespace App\Http\Livewire\Pendidikan;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterPendidikan;
use App\Models\MasterTingkatPendidikan;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $ref_bkn;
    public $nama;
    public $tk_pendidikan_id;
    public $status = 1;

    public function render()
    {
        //dd($this->status);
        $retData = MasterPendidikan::where(function($query){
            if($this->_id != ""){
                $query->where('id', 'like', '%'.$this->_id.'%');
            }

            if($this->ref_bkn != ""){
                $query->where('ref_bkn', 'LIKE', '%'.$this->ref_bkn.'%');
            }

            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }

            if($this->tk_pendidikan_id != ""){
                $query->where('tk_pendidikan_id', '=', $this->tk_pendidikan_id);
            }

            if($this->status != ""){
                $query->where('status', '=', $this->status);
            }
        })->orderByRaw('CONVERT(id, SIGNED) asc')->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.pendidikan.main', [
            'master_pendidikan' => $retData,
            'master_tingkat_pendidikan' => MasterTingkatPendidikan::get(),
        ]);
    }
}
