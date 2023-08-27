<?php

namespace App\Http\Livewire\Personel\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatJabatan;
use App\Models\MasterJabatan;
use App\Models\MasterOPD;
use App\Models\MasterPejabat;
use App\Models\MasterJenisJabatan;
use App\Models\MasterEselon;
use App\Models\MasterJenisArsip;

class RiwJabatan extends Component
{
    public $sid;
    public $method;
    public $next;
    public $subPage = 'list';
    public $dataset;
    public $lblAkhir = "Tidak";
    public $master_riwayat_jabatan;

    public $master_eselon;
    public $master_jabatan;

    public $tmtjab;
    public $kjab;
    public $keselon;

    protected $listeners = ['tambah', 'edit', 'tutup', 'delete'];
    
    public function render()
    {
        $this->master_riwayat_jabatan = MasterRiwayatJabatan::where('nip', '=', $this->sid)->get();

        return view('livewire.personel.riwayat-pegawai.riw-jabatan');
    }

    public function tambah(){
        $this->next = 'store';
        //$this->dataset = [];
        //$this->dataset['nip'] = $this->sid;
        $this->subPage = 'formulir';
    }

    public function edit($value){
        $this->next = 'update';
        $this->subPage = 'formulir';

        //dd($value);

        $this->kjab = $value['kjab'];
        $this->tmtjab = $value['tmtjab'];
        $this->keselon = $value['keselon'];
    }

    public function delete($value){
        $this->master_riwayat_jabatan = MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('tmtjab', '=', $value['tmtjab'])->where('kjab', '=', $value['kjab'])->where('keselon', '=', $value['keselon'])->delete();
    }

    public function tutup(){
        $this->dataset = [];
        //$this->dataset['nip'] = $this->sid;
        $this->tmtjab = '';
        $this->kgolru = '';
        $this->keselon = '';
        $this->subPage = 'list';   
    }
}
