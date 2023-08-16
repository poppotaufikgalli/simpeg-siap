<?php

namespace App\Http\Livewire\JenisPersonel;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MasterJenisPersonel;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $stts=1;
    public $id_jenis_personel;
    public $nama;

    public function render()
    {
        $retData = MasterJenisPersonel::where(function($query){
            if($this->id_jenis_personel != ""){
                $query->where('id_jenis_personel', '=', $this->id_jenis_personel);
            }
            
            if($this->nama != ""){
                $query->where('nama', 'LIKE', '%'.$this->nama.'%');
            }

            if($this->stts != -1){
                $query->where('stts', '=', $this->stts);
            }
        })->Paginate(20)->withQueryString();

        $this->resetPage();

        return view('livewire.jenis-personel.main', [
            'master_jenis_personel' => $retData,
        ]);
    }
}
