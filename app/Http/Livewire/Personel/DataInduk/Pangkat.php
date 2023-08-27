<?php

namespace App\Http\Livewire\Personel\DataInduk;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterPejabat;
use App\Models\MasterPangkat;
use App\Models\MasterJenisKp;
use App\Models\MasterStlud;
use App\Models\MasterRiwayatPangkat;
use App\Models\MasterJenisArsip;

class Pangkat extends Component
{
    public $sid;
    public $id_jenis_personel;
    public $next;
    public $method;
    public $dataset;
    public $jnsdok;
    public $nama;
    public $arsip = [];
    
    public $akhir;

    public $kgolru;
    public $tmtpang;
    public $knpang;

    public $lblAkhir = "Tidak";

    public $master_jenis_arsip = [];

    public function store()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['akhir'] = $data['akhir'] ?? $this->akhir;

        $validator = Validator::make($data, [
            'kgolru' => [
                'required',
                Rule::unique('master_riwayat_pangkat')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('kgolru', '=', $data['kgolru']);
                }),
            ],
            'tmtpang' => [
                'required',
                Rule::unique('master_riwayat_pangkat')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmtpang', '=', $data['tmtpang']);
                }),
            ],
            'knpang' => 'required',
        ],[
            'kgolru.required' => 'Pangkat/Golongan Ruang tidak boleh kosong',
            'kgolru.unique' => 'Pangkat/Golongan Ruang Telah Terdaftar',
            'tmtpang.required' => 'TMT Kenaikan Pangkat tidak boleh kosong',
            'tmtpang.unique' => 'TMT Kenaikan Pangkat Telah Terdaftar',
            'knpang.required' => 'Jenis Kenaikan Pangkat tidak boleh kosong',
            //'knpang.unique' => 'Jenis Kenaikan Pangkat Telah Terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        if($data['akhir'] == 1){
            MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);
        }

        $result = MasterRiwayatPangkat::create($data);
        $this->dispatchBrowserEvent('informations', "Data Pangkat Terakhir berhasil ditambahkan");

        $this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        $this->next = 'update';
        $this->kgolru = $data['kgolru'];
        $this->tmtpang = $data['tmtpang'];

        $this->emitUp('tutup');
    }

    public function update()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['akhir'] = $data['akhir'] ?? $this->akhir;

        $validator = Validator::make($data, [
            'kgolru' => [
                'required',
                Rule::unique('master_riwayat_pangkat')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('kgolru', '=', $data['kgolru'])
                        ->where('tmtpang', '=', $data['tmtpang']);
                })->ignore($this->sid, 'nip')->ignore($this->tmtpang, 'tmtpang')->ignore($this->kgolru, 'kgolru'),
            ],
            'tmtpang' => [
                'required',
                Rule::unique('master_riwayat_pangkat')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('kgolru', '=', $data['kgolru'])
                        ->where('tmtpang', '=', $data['tmtpang']);
                })->ignore($this->sid, 'nip')->ignore($this->tmtpang, 'tmtpang')->ignore($this->kgolru, 'kgolru'),
            ],
            'knpang' => 'required',
        ],[
            'kgolru.required' => 'Pangkat/Golongan Ruang tidak boleh kosong',
            'kgolru.unique' => 'Pangkat/Golongan Ruang Telah Terdaftar',
            'tmtpang.required' => 'TMT Kenaikan Pangkat tidak boleh kosong',
            'tmtpang.unique' => 'TMT Kenaikan Pangkat Telah Terdaftar',
            'knpang.required' => 'Jenis Kenaikan Pangkat tidak boleh kosong',
            //'knpang.unique' => 'Jenis Kenaikan Pangkat Telah Terdaftar',
        ]);

        //dd($validator);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        if($data['akhir'] == 1){
            MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);   
        }
         
        $result = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('kgolru', '=', $this->kgolru)->where('tmtpang', '=', $this->tmtpang)->update($data);
        $this->dispatchBrowserEvent('informations', "Data Pangkat Terakhir berhasil diubah");   

        $this->emitUp('tutup');
    }

    public function getMasterArsip($jns, $nama)
    {
        if($jns != ""){
            $this->master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'pangkat')->get();
            foreach ($this->master_jenis_arsip as $key => $value) {
                $value->jnsdok = $jns;
                $value->nama = $nama;
            }
        }else{
            $this->master_jenis_arsip = [];
        }
    }

    public function changeStts($selId){
        $this->lblAkhir = $selId == 1 ? 'Ya' : 'Tidak';
    }

    public function render()
    {
        return view('livewire.personel.data-induk.pangkat', [
            'master_stlud' => MasterStlud::all(),
            'master_pejabat' => MasterPejabat::all(),
            'master_pangkat' => MasterPangkat::where('id_jenis_personel', '=', $this->id_jenis_personel)->get(),
            'master_naik_pangkat' => MasterJenisKp::where('status', '=', 1)->get(),
            //'master_jenis_arsip' => $master_jenis_arsip,
        ]);
    }

    public function mount()
    {
        if($this->akhir == 1){
            $dataset = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('akhir', '=', 1)->first();
        }else{
            $dataset = MasterRiwayatPangkat::where('nip', '=', $this->sid)->where('kgolru', '=', $this->kgolru)->where('tmtpang', '=', $this->tmtpang)->first();
        }

        //dd($dataset);
        
        if($dataset){
            $this->dataset = $dataset->toArray();
            $this->dataset['nip'] = (string)$dataset->nip;
            $this->getMasterArsip('pangkat'.$dataset->kgolru, "Pangkat ".$dataset->npangkat->nama);

            $this->kgolru = $dataset->kgolru;
            $this->tmtpang = $dataset->tmtpang;
            //$this->knpang = $dataset->knpang;
            $this->changeStts($dataset->akhir);

            $this->method = 'edit';
            $this->next = 'update';
        }else{
            $this->method = 'create';
            $this->next = 'store';
            $this->dataset['nip'] = $this->sid;
        }
    }
}
