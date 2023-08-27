<?php

namespace App\Http\Livewire\Personel\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatGajiBerkala;
use App\Models\MasterPangkat;
use App\Models\MasterStlud;
use App\Models\MasterPejabat;
use App\Models\MasterJenisKp;

class RiwKgb extends Component
{
    public $sid;
    public $method;
    public $next;
    public $subPage = 'list';
    public $dataset;
    public $lblAkhir = "Tidak";
    public $master_riwayat_gajiberkala;

    public $tmtngaj;

    protected $listeners = ['tambah', 'edit', 'tutup', 'delete'];
    
    public function render()
    {
        $this->master_riwayat_gajiberkala =  MasterRiwayatGajiBerkala::where('nip', '=', $this->sid)->get();

        return view('livewire.personel.riwayat-pegawai.riw-kgb');
    }

    public function tambah(){
        //$this->next = 'store';
        $this->subPage = 'formulir';
    }

    public function edit($value){
        $this->next = 'update';
        $this->subPage = 'formulir';

        //dd($value);
        $this->tmtngaj = $value['tmtngaj'];
    }

    public function delete($value){
        $this->master_riwayat_gajiberkala = MasterRiwayatGajiBerkala::where('nip', '=', $this->sid)->where('tmtngaj', '=', $value['tmtngaj'])->delete();
    }

    public function tutup(){
        $this->tmtngaj = '';
        $this->subPage = 'list';   
    }
}
