<?php

namespace App\Http\Livewire\JenisJabatan;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisJabatan;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $status=1;
    public $_id;
    public $nama;
    public $ref_simpeg;
    public $ref_siap;
    public $is_ak;

    public function render()
    {
        $retData = MasterJenisJabatan::where(function($query){
            if($this->_id != ""){
                $query->where('id', '=', $this->_id);
            }
            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }

            if($this->ref_simpeg != ""){
                $query->where('ref_simpeg', '=', $this->ref_simpeg);
            }

            if($this->ref_siap != ""){
                $query->where('ref_siap', '=', $this->ref_siap);
            }

            if($this->is_ak != ""){
                $query->where('is_ak', '=', $this->is_ak);
            }

            if($this->status != ""){
                $query->where('status', '=', $this->status);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.jenis-jabatan.main', [
            'master_jenis_jabatan' => $retData,
        ]);
    }
}
