<?php

namespace App\Http\Livewire\Personel\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterCpns;
use App\Models\MasterPns;

use App\Models\MasterRiwayatPangkat;
use App\Models\MasterPangkat;
use App\Models\MasterStlud;
use App\Models\MasterPejabat;
use App\Models\MasterJenisKp;

class RiwPangkat extends Component
{
    public $sid;
    public $id_jenis_personel;
    public $id_korps;
    public $method;
    public $next;
    public $subPage = 'list';
    public $dataset;
    public $lblAkhir = "Tidak";
    public $master_riwayat_pangkat;

    public $master_cpns;
    public $master_pns;

    public $tmtpang;
    public $kgolru;
    public $knpang;

    protected $listeners = ['tambah', 'edit', 'tutup', 'delete', "callModal"];

    public function callModal($ngolru, $kgolru, $tmtpang){
        //$type, $name, $hash, $table, $key
        //$hash = preg_replace("![^a-z0-9]+!i", "-", strtolower($nama_jkeluarga));
        $name = $kgolru .'_'. date('d-m-Y',strtotime($tmtpang));
        $this->emitTo('modal-upload-arsip-personel', 'openModalPersonel', $ngolru, $name, 'riw-pangkat', 'master_riwayat_pangkat', [
            'nip' => $this->sid,
            'kgolru' => $kgolru,
            'tmtpang' => $tmtpang,
        ]);
    }
    
    public function render()
    {
        $this->master_riwayat_pangkat =  MasterRiwayatPangkat::where('nip', '=', $this->sid)->get();
        $this->master_cpns = MasterCpns::where('nip', '=', $this->sid)->first();
        $this->master_pns = MasterPns::where('nip', '=', $this->sid)->first();

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
