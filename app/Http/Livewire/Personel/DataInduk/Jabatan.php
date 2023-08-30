<?php

namespace App\Http\Livewire\Personel\DataInduk;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

//use App\Models\MasterInstansi;
use App\Models\MasterJabatan;
use App\Models\MasterOPD;
use App\Models\MasterPejabat;
use App\Models\MasterJenisJabatan;
use App\Models\MasterEselon;
use App\Models\MasterRiwayatJabatan;
use App\Models\MasterJenisArsip;

class Jabatan extends Component
{
    public $sid;
    public $next;
    public $method;
    public $dataset;
    public $jnsdok;
    public $arsip = [];
    public $nama;

    public $master_sub_opd;
    public $master_eselon;
    public $master_jabatan;

    public $kjab;
    public $tmtjab;
    public $keselon;

    public $akhir;
    public $lblAkhir = 'Tidak';
    //public $master_jenis_jabatan;

    public function render()
    {
        if($this->jnsdok){
            $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'jabatan')->get();
            foreach ($master_jenis_arsip as $key => $value) {
                $value->jnsdok = $this->jnsdok;
                $value->nama = $this->nama;
            }
        }else{
            $master_jenis_arsip = [];
        }

        return view('livewire.personel.data-induk.jabatan', [
            'master_opd' => MasterOPD::where('status', '=', 1)->get(),
            'master_jenis_jabatan' => MasterJenisJabatan::where('status', '=', 1)->get(),
            'master_pejabat' => MasterPejabat::all(),
            'master_jenis_arsip' => $master_jenis_arsip,
            //'master_instansi' => MasterInstansi::all(),
        ]);
    }

    public function searchJabatan()
    {
        //dd($this->dataset);
        $retData = MasterJabatan::where(function($query){
            if(isset($this->dataset['id_opd']) && $this->dataset['id_opd'] != ""){
                $query->where('id_opd', '=', $this->dataset['id_opd']);
            }

            if(isset($this->dataset['jnsjab']) && $this->dataset['jnsjab'] != ""){
                $query->where('id_jenis_jabatan', '=', $this->dataset['jnsjab']);
            }

            if(isset($this->dataset['keselon']) &&$this->dataset['keselon'] != ""){
                $query->where('id_eselon', '=', $this->dataset['keselon']);
            }
        })->get();
        $this->master_jabatan = $retData;
        
    }

    public function changeJnsJab($selId){
        $this->dataset['keselon'] = "";
        $master_eselon = MasterEselon::where('status', '=', 1)->where('id_jenis_jabatan', '=', $selId)->get();  
        if(count($master_eselon) > 0){
            $this->master_eselon = $master_eselon;    
        }else{
            $this->master_eselon = [];    
        }
        
        $this->searchJabatan(); 
    }

    public function checkJabatan($selId)
    {
        /*$retData = MasterJabatan::find($selId);
        dd($retData);
        $this->dataset['id_opd'] = $retData['id_opd'];
        $this->dataset['jnsjab'] = $retData['id_jenis_jabatan'];
        $this->changeJnsJab($retData['id_jenis_jabatan']);
        $this->dataset['keselon'] = $retData['id_eselon'];
        $this->dataset['njab'] = $retData['nama'];
        $this->dataset['sjab'] = $retData['id'];*/
    }

    public function changeStts($selId)
    {
        $lblAkhir = $selId == 1 ? "Ya" : "Tidak";
    }

    public function mount()
    {
        if($this->akhir == 1){
            $dataset = MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('akhir', '=', 1)->first();    
        }else{
            $dataset = MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('tmtjab', '=', $this->tmtjab)->first();
        }
        
        if($dataset){
            //dd($dataset);
            $this->dataset['nip'] = (string)$dataset->nip;
            $this->changeJnsJab($dataset->jnsjab);
            $this->jnsdok = "jabatan".date('dmY', strtotime($dataset->tmtjab));
            $this->tmtjab = $dataset->tmtjab;
            $this->nama = $dataset->njab;
            $this->dataset = $dataset->toArray();
            $this->method = 'edit';
            $this->next = 'update';
            //$this->checkJabatan($dataset->kjab);
            //$this->changeJnsJab($dataset->id_jenis_jabatan);
        }else{
            $this->method = 'create';
            $this->next = 'store';
            $this->dataset['nip'] = $this->sid;
        }
    }

    public function getkjab()
    {
        //$this->dataset['kjab'] = $this->dataset['id_opd'].$this->dataset['jnsjab'].$this->dataset['keselon'];
        //
    }

    public function store()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['akhir'] = $data['akhir'] ?? $this->akhir;

        $validator = Validator::make($data, [
            'tmtjab' => [
                'required',
                Rule::unique('master_riwayat_jabatan')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmtjab', '=', $data['tmtjab']);
                }),
            ],
        ],[
            'tmtjab.required' => 'TMT Jabatan tidak boleh kosong',
            'tmtjab.unique' => 'TMT Jabatan Telah Terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        $retData = MasterJabatan::where('nama', '=', $data['njab'])->where('id_jenis_jabatan', '=', $data['jnsjab'])->first();
        if($retData){
            $data['kjab'] = $retData['id'];
        }else{
            $ret = MasterJabatan::select('id')->where('id_opd', '=', $data['id_opd'])->where('id_jenis_jabatan', '=', $data['jnsjab'])->where('id_eselon', '=', $data['keselon'])->orderByRaw('CONVERT(id, SIGNED) desc')->first();

            if($ret){
                $data['kjab'] = $ret['id'] +1;
            }else{
                $data['kjab'] = $data['id_opd'].$data['jnsjab'].$data['keselon']."01";
            }

            MasterJabatan::create([
                'id' => $data['kjab'],
                'parent_id' => $data['id_opd'],
                'id_opd' => $data['id_opd'],
                'nama' => $data['njab'],
                'id_eselon' => $data['keselon'],
                'id_jenis_jabatan' => $data['jnsjab'],
            ]);
        }

        if($data['akhir'] == 1){
            MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);
        }

        MasterRiwayatJabatan::create($data);
        $this->dispatchBrowserEvent('informations', "Data Jabatan Terakhir berhasil ditambahkan");

        $this->emitUp('tutup');
    }

    public function update()
    {
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['akhir'] = $data['akhir'] ?? $this->akhir;

        $validator = Validator::make($data, [
            'tmtjab' => [
                'required',
                Rule::unique('master_riwayat_jabatan')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmtjab', '=', $data['tmtjab']);
                })->ignore($this->sid, 'nip')->ignore($this->tmtjab, 'tmtjab'),
            ],
        ],[
            'tmtjab.required' => 'TMT Jabatan tidak boleh kosong',
            'tmtjab.unique' => 'TMT Jabatan Telah Terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        $retData = MasterJabatan::where('nama', '=', $data['njab'])->where('id_jenis_jabatan', '=', $data['jnsjab'])->first();
        if($retData){
            $data['kjab'] = $retData['id'];
        }else{
            $ret = MasterJabatan::select('id')->where('id_opd', '=', $data['id_opd'])->where('id_jenis_jabatan', '=', $data['jnsjab'])->where('id_eselon', '=', $data['keselon'])->orderByRaw('CONVERT(id, SIGNED) desc')->first();

            if($ret){
                $data['kjab'] = $ret['id'] +1;
            }else{
                $data['kjab'] = $data['id_opd'].$data['jnsjab'].$data['keselon']."01";
            }

            MasterJabatan::create([
                'id' => $data['kjab'],
                'parent_id' => $data['id_opd'],
                'id_opd' => $data['id_opd'],
                'nama' => $data['njab'],
                'id_eselon' => $data['keselon'],
                'id_jenis_jabatan' => $data['jnsjab'],
            ]);
        }

        if($data['akhir'] == 1){
            MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);
        }

        MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('tmtjab', '=', $this->dataset['tmtjab'])->update($data);
        $this->dispatchBrowserEvent('informations', "Data Jabatan Terakhir berhasil diubah");    

        $this->emitUp('tutup');
    }
}
