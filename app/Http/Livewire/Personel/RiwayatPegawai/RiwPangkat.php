<?php

namespace App\Http\Livewire\Personel\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatPangkat;
use App\Models\MasterPangkat;
use App\Models\MasterStlud;
use App\Models\MasterPejabat;
use App\Models\MasterJenisKp;

class RiwPangkat extends Component
{
    public $sid;
    public $method;
    public $next;
    public $subPage = 'list';
    public $dataset;
    public $lblAkhir = "Tidak";
    public $master_riwayat_pangkat;

    public $tmtpang;
    public $kgolru;
    public $knpang;

    protected $listeners = ['tambah', 'edit', 'tutup', 'delete'];
    
    public function render()
    {
        $this->master_riwayat_pangkat =  MasterRiwayatPangkat::where('nip', '=', $this->sid)->get();

        return view('livewire.personel.riwayat-pegawai.riw-pangkat');
    }

    public function tambah(){
        //$this->next = 'store';
        $this->subPage = 'formulir';
    }

    public function edit($value){
        $this->next = 'update';
        $this->subPage = 'formulir';

        $this->tmtpang = $value['tmtpang'];
        $this->kgolru = $value['kgolru'];
        $this->knpang = $value['knpang'];
    }

    public function delete($value){
        $this->master_riwayat_pangkat = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('kgolru', '=', $value['kgolru'])->where('tmtpang', '=', $value['tmtpang'])->where('knpang', '=', $value['knpang'])->delete();
    }

    public function tutup(){
        //$this->dataset = [];
        //$this->dataset['nip'] = $this->sid;
        $this->tmtpang = '';
        $this->kgolru = '';
        $this->knpang = '';
        $this->subPage = 'list';   
    }
}
