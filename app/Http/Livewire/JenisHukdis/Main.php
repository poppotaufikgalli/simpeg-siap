<?php

namespace App\Http\Livewire\JenisHukdis;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisHukdis;
class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $_id;
    public $nama;
    public $ref_simpeg;
    public $jenis_tingkat_hukuman_id;

    public function render()
    {
        $retData = MasterJenisHukdis::where(function($query){
            if($this->_id != ""){
                $query->where('id', '=', $this->_id);
            }

            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }

            if($this->ref_simpeg != ""){
                $query->where('ref_simpeg', '=', $this->ref_simpeg);
            }

            if($this->jenis_tingkat_hukuman_id != ""){
                $query->where('jenis_tingkat_hukuman_id', '=', $this->jenis_tingkat_hukuman_id);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.jenis-hukdis.main', [
            'master_jenis_hukdis' => $retData,
        ]);
    }
}
