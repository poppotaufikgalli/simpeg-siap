<?php

namespace App\Http\Livewire\Pegawai\DataInduk;

use Livewire\Component;

use App\Models\MasterPejabat;
use App\Models\MasterPangkat;
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

    public function submit()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        MasterPns::updateOrCreate( ['nip' => $this->sid], $data);
        $this->dispatchBrowserEvent('informations', "Data PNS berhasil ditambahkan");    
    }

    public function render()
    {
        return view('livewire.pegawai.data-induk.pns', [
            'master_pejabat' => MasterPejabat::get(),
            'master_pangkat' => MasterPangkat::get(),
            'master_jenis_arsip' => MasterJenisArsip::where('jnsdok', '=', 'pns')->get(),
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
        }else{
            $this->method = 'create';
        }
    }
}
