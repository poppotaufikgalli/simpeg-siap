<?php

namespace App\Http\Livewire\Pegawai\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatPangkat;
use App\Models\MasterPangkat;
use App\Models\MasterStlud;
use App\Models\MasterPejabat;
use App\Models\MasterJenisKp;

class RiwKgb extends Component
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

    protected $listeners = ['tambah', 'edit', 'tutup', 'delete'];
    
    public function render()
    {
        $this->master_riwayat_pangkat =  MasterRiwayatPangkat::where('nip', '=', $this->sid)->get();

        return view('livewire.pegawai.riwayat-pegawai.riw-kgb', [
            //'master_riwayat_pangkat' => $retData,
            'master_stlud' => MasterStlud::all(),
            'master_pejabat' => MasterPejabat::all(),
            'master_pangkat' => MasterPangkat::all(),
            'master_naik_pangkat' => MasterJenisKp::all(),
            'master_jenis_arsip' => [],
        ]);
    }

    public function changeAkhir($selId){
        $this->lblAkhir = $selId == true ? 'Ya' : 'Tidak';
    }

    public function tambah(){
        $this->next = 'store';
        $this->dataset = [];
        $this->dataset['nip'] = $this->sid;
        $this->subPage = 'formulir';
    }

    public function edit($kgolru, $tmtpang){
        $this->next = 'update';
        $this->subPage = 'formulir';

        $this->tmtpang = $tmtpang;
        $this->kgolru = $kgolru;

        $dataset = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('kgolru', '=', $kgolru)->where('tmtpang', '=', $tmtpang)->first();
        if($dataset){
            $this->dataset = $dataset->toArray();
            $this->changeAkhir($dataset->akhir);
        }
        //dd($dataset);
    }

    public function delete($kgolru, $tmtpang){
        $this->master_riwayat_pangkat = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('kgolru', '=', $kgolru)->where('tmtpang', '=', $tmtpang)->delete();
    }

    public function tutup(){
        $this->dataset = [];
        $this->dataset['nip'] = $this->sid;
        $this->tmtpang = '';
        $this->kgolru = '';
        $this->subPage = 'list';   
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        //dd($data);

        if(isset($data['akhir']) && $data['akhir'] == true){
            MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);    
        }

        $validator = Validator::make($data, [
            //'nip' => 'required',
            'kgolru' => [
                'required',
                Rule::unique('master_riwayat_pangkat')->where(function ($query) use ($data) {
                    return $query->where('nip', $this->sid)
                        ->where('kgolru', $data['kgolru'])
                        ->where('tmtpang', $data['tmtpang']);
                })->ignore($this->sid, 'nip')->ignore($this->kgolru, 'kgolru')->ignore($this->tmtpang, 'tmtpang')],
        ],[
            'kgolru.required' => 'Golongan Ruang tidak boleh kosong',
            'kgolru.unique' => 'Golongan Ruang Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        if($this->kgolru == $data['kgolru'] && $this->tmtpang == $data['tmtpang']){
            $this->master_riwayat_pangkat = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('kgolru', '=', $this->kgolru)->where('tmtpang', '=', $this->tmtpang)->update($data);
            $this->dispatchBrowserEvent('informations', "Data Riwayat Gaji Berkala berhasil diubah");    

            $this->subPage = 'list';
        }else{
            $this->dispatchBrowserEvent('errors', [['Riwayat Pangkat Telah Terdaftar']]);
        }
    }

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        if(isset($data['akhir']) && $data['akhir'] == true){
            MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);    
        }

        $validator = Validator::make($data, [
            //'nip' => 'required',
            'kgolru' => [
                'required',
                Rule::unique('master_riwayat_pangkat')->where(function ($query) use ($data){
                    return $query->where('nip', $data['nip'])
                        ->where('kgolru', $data['kgolru'])
                        ->where('tmtpang', $data['tmtpang']);
                })],
        ],[
            'kgolru.required' => 'Golongan Ruang tidak boleh kosong',
            'kgolru.unique' => 'Golongan Ruang Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }
        
        $validator->validate();

        $this->master_riwayat_pangkat = MasterRiwayatPangkat::create($data);
        $this->dispatchBrowserEvent('informations', "Data Riwyat Gaji Berkala berhasil ditambahkan");  

        $this->subPage = 'list';
    }
}
