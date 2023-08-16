<?php

namespace App\Http\Livewire\Pegawai\DataInduk;

use Livewire\Component;

use App\Models\MasterPejabat;
use App\Models\MasterOPD;
use App\Models\MasterRiwayatGajiBerkala;

class GajiBerkala extends Component
{
    public $sid;
    public $next;
    public $method;
    public $dataset;
    public $master_opd;
    public $akhir = 0;

    protected function delAkhir()
    {
        MasterRiwayatGajiBerkala::where('nip', '=', $this->sid)->update([
            'akhir' => 0,
        ]);
    }

    public function store()
    {
        //dd($this->dataset);

        $this->delAkhir();

        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);
        $data['gpokkhir'] = preg_replace("/[^0-9]/", "", $data['gpokkhir']);
        $data['akhir'] = $this->akhir;

        MasterRiwayatGajiBerkala::create($data);
        $this->dispatchBrowserEvent('informations', "Data Gaji Berkala Terakhir berhasil ditambahkan");

        $this->next = 'update';
        $this->method = 'edit';
    }

    public function update()
    {
        $this->delAkhir();

        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);
        $data['gpokkhir'] = preg_replace("/[^0-9]/", "", $data['gpokkhir']);
        $data['akhir'] = $this->akhir;

        MasterRiwayatGajiBerkala::where('nip', '=', $this->sid)->where('tmtngaj', '=', $this->dataset['tmtngaj'])->update($data);
        $this->dispatchBrowserEvent('informations', "Data Gaji Berkala Terakhir berhasil diubah");    
    }

    public function changeNunker($selId)
    {
        $filtered = ($this->master_opd)->firstWhere('nama', $selId);
        if($filtered){
            $this->dataset['id_opd'] = $filtered->id;    
        }else{
            $this->dataset['id_opd'] = null;    
        }
    }
    
    public function render()
    {
        return view('livewire.pegawai.data-induk.gaji-berkala', [
            'master_pejabat' => MasterPejabat::get(),
            'master_opd' => $this->master_opd,
        ]);
    }

    public function mount()
    {
        $this->master_opd = MasterOPD::where('sfilter', '=', 1)->get();
        $dataset = MasterRiwayatGajiBerkala::where('nip', '=', $this->sid)->where('akhir', '=', 1)->orderBy('tmtngaj', 'desc')->first();
        //dd($dataset);
        if($dataset){
            $this->dataset = $dataset->toArray();
            $this->dataset['nip'] = (string)$dataset->nip;
            //$this->jnsdok = strlen((string)$dataset->kgolru) <= 2 ? "pangkat1".$dataset->kgolru : "pangkat".$dataset->kgolru ;
            //$this->nama = $dataset->npangkat->nama_pangkat ." (". $dataset->npangkat->nama.")";
            $this->method = 'edit';
            $this->next = 'update';
        }else{
            $this->dataset['nip'] = $this->sid;
            $this->method = 'create';
            $this->next = 'store';
        }
    }
}
