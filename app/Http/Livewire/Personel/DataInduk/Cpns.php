<?php

namespace App\Http\Livewire\Personel\DataInduk;

use Livewire\Component;
//use Livewire\WithFileUploads;

use App\Models\MasterPejabat;
use App\Models\MasterPangkat;
use App\Models\MasterRiwayatPangkat;

use App\Models\MasterCpns;
use App\Models\MasterJenisArsip;

use Storage;

class Cpns extends Component
{
    //use WithFileUploads;

    public $sid;
    public $id_jenis_personel;
    public $next;
    public $method;
    public $dataset;
    public $arsip = [];

    public $master_jenis_arsip = [];

    public function submit()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $result = MasterCpns::updateOrCreate( ['nip' => $this->sid], $data);
        $this->dispatchBrowserEvent('informations', "Data CPNS berhasil ditambahkan");  

        $this->getMasterArsip();
        $this->next = 'update';  

        //$this->addRiwCPNS($data);
    }

    public function addRiwCPNS($data)
    {
        #211
        $insertData = [
            'nip' => $this->sid,
            'ptetap' => $data['kpej'],
            'nskpang' => $data['skcpns'],
            'tskpang' => $data['tskcpns'],
            'tmtpang' => $data['tmtcpns'],
            'kgolru' => $data['kgolru'],
            'knpang' => 211,
            'mskerja' => $data['mskerjath'],
            'blnkerja' => $data['mskerjabl'],
        ];

        $exists = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('knpang', '=', 211)->first();
        if($exists){
            MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('knpang', '=', 211)->update($insertData);
        }else{
            MasterRiwayatPangkat::create($insertData);
        }
        
    }

    public function render()
    {
        return view('livewire.personel.data-induk.cpns', [
            'master_pejabat' => MasterPejabat::get(),
            'master_pangkat' => MasterPangkat::get(),
            //'master_jenis_arsip' => MasterJenisArsip::where('jnsdok', '=', 'cpns')->get(),
        ]);
    }

    public function getMasterArsip()
    {
        $this->master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'cpns')->get();
    }

    public function mount()
    {
        $dataset = MasterCpns::where('nip', '=', $this->sid)->first();
        if($dataset){
            $this->dataset = $dataset->toArray();
            $this->dataset['nip'] = (string)$dataset->nip;
            $this->method = 'edit';
            $this->next = 'update';
            $this->getMasterArsip();
        }else{
            $this->dataset['nip'] = $this->sid; 
            $this->method = 'create';
            $this->next = 'store';
        }
    }
}
