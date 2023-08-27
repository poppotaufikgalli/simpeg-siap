<?php

namespace App\Http\Livewire\Personel\DataInduk;

use Livewire\Component;

use App\Models\MasterPejabat;
use App\Models\MasterPangkat;
use App\Models\MasterRiwayatPangkat;
use App\Models\MasterPns;
use App\Models\MasterJenisArsip;

class Pns extends Component
{
    public $sid;
    public $next;
    public $method;
    public $dataset;
    public $lblSumpah = "Belum";

    public $arsip = [];
    public $master_jenis_arsip = [];

    public function submit()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        MasterPns::updateOrCreate( ['nip' => $this->sid], $data);
        $this->dispatchBrowserEvent('informations', "Data PNS berhasil ditambahkan");    

        $this->getMasterArsip();
        $this->next = 'update';  

        //$this->addRiwPNS($data);
    }

    public function addRiwPNS($data)
    {
        #211
        $insertData = [
            'nip' => $this->sid,
            'ptetap' => $data['kpej'],
            'nskpang' => $data['skpns'],
            'tskpang' => $data['tskpns'],
            'tmtpang' => $data['tmtpns'],
            'kgolru' => $data['kgolru'],
            'knpang' => 212,
            //'mskerja' => $data['mskerjath'],
            //'blnkerja' => $data['mskerjabl'],
        ];

        $exists = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('knpang', '=', 211)->first();
        if($exists){
            MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('knpang', '=', 211)->update($insertData);
        }else{
            MasterRiwayatPangkat::create($insertData);
        }
        
    }

    public function getMasterArsip()
    {
        $this->master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'pns')->get();
    }

    public function render()
    {
        return view('livewire.personel.data-induk.pns', [
            'master_pejabat' => MasterPejabat::get(),
            'master_pangkat' => MasterPangkat::get(),
            //'master_jenis_arsip' => MasterJenisArsip::where('jnsdok', '=', 'pns')->get(),
        ]);
    }

    public function changeStts($selId)
    {
        $this->lblSumpah = $selId == 1 ? "Sudah" : "Belum";
    }

    public function mount()
    {
        $dataset = MasterPns::where('nip', '=', $this->sid)->first();
        if($dataset){
            $this->dataset = $dataset->toArray();
            $this->dataset['nip'] = (string)$dataset->nip;
            $this->method = 'edit';
            $this->getMasterArsip();
        }else{
            $this->dataset['nip'] = $this->sid;
            $this->method = 'create';
        }
    }
}
