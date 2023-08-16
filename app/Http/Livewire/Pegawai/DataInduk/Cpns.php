<?php

namespace App\Http\Livewire\Pegawai\DataInduk;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\MasterPejabat;
use App\Models\MasterPangkat;

use App\Models\MasterCpns;
use App\Models\MasterJenisArsip;

use Storage;

class Cpns extends Component
{
    use WithFileUploads;

    public $sid;
    public $next;
    public $method;
    public $dataset;
    public $arsip = [];

    public function submit()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        MasterCpns::updateOrCreate( ['nip' => $this->sid], $data);
        $this->dispatchBrowserEvent('informations', "Data CPNS berhasil ditambahkan");    
    }

    public function render()
    {
        return view('livewire.pegawai.data-induk.cpns', [
            'master_pejabat' => MasterPejabat::get(),
            'master_pangkat' => MasterPangkat::get(),
            'master_jenis_arsip' => MasterJenisArsip::where('jnsdok', '=', 'cpns')->get(),
        ]);
    }

    public function mount()
    {
        $dataset = MasterCpns::where('nip', '=', $this->sid)->first();
        if($dataset){
            $this->dataset = $dataset->toArray();
            $this->dataset['nip'] = (string)$dataset->nip;
            $this->method = 'edit';
        }else{
            $this->dataset['nip'] = $this->sid; 
            $this->method = 'create';
        }
    }
}
