<?php

namespace App\Http\Livewire\Personel\DataInduk;

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
    public $akhir;
    public $lblAkhir = 'Tidak';
    public $tmtngaj;

    public function store()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['akhir'] = $data['akhir'] ?? $this->akhir;

        if($data['akhir'] == 1){
            MasterRiwayatGajiBerkala::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);   
        }

        $data['gpokkhir'] = preg_replace("/[^0-9]/", "", $data['gpokkhir']);
        //$data['akhir'] = $this->akhir;

        MasterRiwayatGajiBerkala::create($data);
        $this->dispatchBrowserEvent('informations', "Data Gaji Berkala Terakhir berhasil ditambahkan");

        $this->next = 'update';
        $this->method = 'edit';

        $this->emitUp('tutup');
    }

    public function update()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['akhir'] = $data['akhir'] ?? $this->akhir;

        if($data['akhir'] == 1){
            MasterRiwayatGajiBerkala::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);   
        }

        $data['gpokkhir'] = preg_replace("/[^0-9]/", "", $data['gpokkhir']);
        //$data['akhir'] = $this->akhir;

        MasterRiwayatGajiBerkala::where('nip', '=', $this->sid)->where('tmtngaj', '=', $this->dataset['tmtngaj'])->update($data);
        $this->dispatchBrowserEvent('informations', "Data Gaji Berkala Terakhir berhasil diubah");    

        $this->emitUp('tutup');
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
        return view('livewire.personel.data-induk.gaji-berkala', [
            'master_pejabat' => MasterPejabat::get(),
            'master_opd' => $this->master_opd,
        ]);
    }

    public function changeStts($selId)
    {
        $this->lblAkhir = $selId == 1 ? "Ya" : "Tidak";
    }

    public function mount()
    {
        $this->master_opd = MasterOPD::where('sfilter', '=', 1)->where('status', '=', 1)->get();

        if($this->akhir == 1){
            $dataset = MasterRiwayatGajiBerkala::where('nip', '=', $this->sid)->where('akhir', '=', 1)->first();
        }else{
            $dataset = MasterRiwayatGajiBerkala::where('nip', '=', $this->sid)->where('tmtngaj', '=', $this->tmtngaj)->first();
        }
        
        if($dataset){
            $this->dataset = $dataset->toArray();
            $this->dataset['nip'] = (string)$dataset->nip;
            $this->changeStts($dataset->akhir);
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
