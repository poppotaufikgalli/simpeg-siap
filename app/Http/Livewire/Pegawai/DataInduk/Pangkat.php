<?php

namespace App\Http\Livewire\Pegawai\DataInduk;

use Livewire\Component;

use App\Models\MasterPejabat;
use App\Models\MasterPangkat;
use App\Models\MasterJenisKp;
use App\Models\MasterStlud;
use App\Models\MasterRiwayatPangkat;
use App\Models\MasterJenisArsip;

class Pangkat extends Component
{
    public $sid;
    public $next;
    public $method;
    public $dataset;
    public $jnsdok;
    public $nama;
    public $arsip = [];
    public $akhir = 1;

    public function submit()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['akhir'] = $this->akhir;

        MasterRiwayatPangkat::where('nip', '=', $this->sid)->update([
            'akhir' => 0,
        ]);

        $exists = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('kgolru', '=', $this->dataset['kgolru'])->where('tmtpang', '=', $this->dataset['tmtpang'])->first();
        if($exists){
            MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('kgolru', '=', $this->dataset['kgolru'])->where('tmtpang', '=', $this->dataset['tmtpang'])->update($data);
            $this->dispatchBrowserEvent('informations', "Data Jabatan Terakhir berhasil diubah");    
        }else{
            MasterRiwayatPangkat::create($data);
            $this->dispatchBrowserEvent('informations', "Data Jabatan Terakhir berhasil ditambahkan");    
        }
    }

    public function render()
    {
        if($this->jnsdok){
            $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'pangkat')->get();
            foreach ($master_jenis_arsip as $key => $value) {
                $value->jnsdok = $this->jnsdok;
                $value->nama = "Pangkat ". $this->nama;
            }
        }else{
            $master_jenis_arsip = [];
        }

        return view('livewire.pegawai.data-induk.pangkat', [
            'master_stlud' => MasterStlud::all(),
            'master_pejabat' => MasterPejabat::all(),
            'master_pangkat' => MasterPangkat::all(),
            'master_naik_pangkat' => MasterJenisKp::all(),
            'master_jenis_arsip' => $master_jenis_arsip,
        ]);
    }

    public function mount()
    {
        $dataset = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('akhir', '=', 1)->first();
        if($dataset){
            $this->dataset = $dataset->toArray();
            $this->dataset['nip'] = (string)$dataset->nip;
            $this->jnsdok = strlen((string)$dataset->kgolru) <= 2 ? "pangkat1".$dataset->kgolru : "pangkat".$dataset->kgolru ;
            $this->nama = $dataset->npangkat->nama_pangkat ." (". $dataset->npangkat->nama.")";
            $this->method = 'edit';
        }else{
            $this->method = 'create';
        }
    }
}
