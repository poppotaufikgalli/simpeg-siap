<?php

namespace App\Http\Livewire\Pegawai\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatJabatan;
use App\Models\MasterJabatan;
use App\Models\MasterOPD;
use App\Models\MasterPejabat;
use App\Models\MasterJenisJabatan;
use App\Models\MasterEselon;
use App\Models\MasterJenisArsip;

class RiwJabatan extends Component
{
    public $sid;
    public $method;
    public $next;
    public $subPage = 'list';
    public $dataset;
    public $lblAkhir = "Tidak";
    public $master_riwayat_jabatan;

    public $master_eselon;
    public $master_jabatan;

    public $tmtjab;
    public $kjab;

    protected $listeners = ['tambah', 'edit', 'tutup', 'delete'];
    
    public function render()
    {
        $this->master_riwayat_jabatan = MasterRiwayatJabatan::where('nip', '=', $this->sid)->get();

        return view('livewire.pegawai.riwayat-pegawai.riw-jabatan', [
            //'master_riwayat_jabatan' => $retData,
            'master_opd' => MasterOPD::where('sfilter', '=', 1)->where('status', '=', 1)->get(),
            'master_jenis_jabatan' => MasterJenisJabatan::where('status', '=', 1)->get(),
            'master_pejabat' => MasterPejabat::all(),
            'master_jenis_arsip' => [],
            //'master_pangkat' => MasterPangkat::all(),
        ]);
    }

    public function changeAkhir($selId){
        $this->lblAkhir = $selId == true ? 'Ya' : 'Tidak';
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
        $retData = MasterJabatan::find($selId);
        //dd($retData);
        $this->dataset['id_opd'] = $retData['id_opd'];
        $this->dataset['jnsjab'] = $retData['id_jenis_jabatan'];
        $this->changeJnsJab($retData['id_jenis_jabatan']);
        $this->dataset['keselon'] = $retData['id_eselon'];
        $this->dataset['njab'] = $retData['nama'];
        $this->dataset['sjab'] = $retData['id'];
    }

    public function tambah(){
        $this->next = 'store';
        $this->dataset = [];
        $this->dataset['nip'] = $this->sid;
        $this->subPage = 'formulir';
    }

    public function edit($kjab, $tmtjab){
        $this->next = 'update';
        $this->subPage = 'formulir';

        $this->kjab = $kjab;
        $this->tmtjab = date('Y-m-d', strtotime($tmtjab));

        $dataset = MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('tmtjab', '=', $tmtjab)->where('kjab', '=', $kjab)->first();
        if($dataset){
            $this->dataset = $dataset->toArray();
            $this->changeAkhir($dataset->akhir);
            $this->checkJabatan($dataset->kjab);
        }
    }

    public function delete($kjab, $tmtjab){
        $this->master_riwayat_jabatan = MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('tmtjab', '=', $tmtjab)->where('kjab', '=', $kjab)->delete();
    }

    public function tutup(){
        $this->dataset = [];
        $this->dataset['nip'] = $this->sid;
        $this->tmtjab = '';
        //$this->kgolru = '';
        $this->subPage = 'list';   
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        if(isset($data['akhir']) && $data['akhir'] == true){
            MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);    
        }

        $validator = Validator::make($data, [
            //'nip' => 'required',
            'tmtjab' => [
                'required',
                Rule::unique('master_riwayat_jabatan')->where(function ($query) use ($data){
                    return $query
                        ->where('nip', '=', $data['nip'])
                        ->where('kjab', '=', $data['kjab'])
                        ->where('tmtjab', '=', $data['tmtjab']);
                })->ignore($this->sid, 'nip', $this->kjab, 'kjab', $this->tmtjab, 'tmtjab')],
        ],[
            'tmtjab.required' => 'Jabatan tidak boleh kosong',
            'tmtjab.unique' => 'Jabatan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }
        
        $validator->validate();

        if($this->kjab == $data['kjab'] && $this->tmtjab == $data['tmtjab']){
            $this->master_riwayat_jabatan = MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('tmtjab', '=', $this->tmtjab)->where('kjab', '=', $this->kjab)->update($data);    

            $this->dispatchBrowserEvent('informations', "Data Jabatan Terakhir berhasil diubah");  
            $this->subPage = 'list';
        }else{
            $this->dispatchBrowserEvent('errors', [['Riwayat Jabatan Telah Terdaftar']]);
        }
    }

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        if(isset($data['akhir']) && $data['akhir'] == true){
            MasterRiwayatJabatan::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);    
        }

        $validator = Validator::make($data, [
            //'nip' => 'required',
            'tmtjab' => [
                'required',
                Rule::unique('master_riwayat_jabatan')->where(function ($query) use ($data){
                    return $query->where('nip', $data['nip'])
                        ->where('kjab', $data['kjab'])
                        ->where('tmtjab', $data['tmtjab']);
                })],
        ],[
            'tmtjab.required' => 'Jabatan tidak boleh kosong',
            'tmtjab.unique' => 'Jabatan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }
        
        $validator->validate();

        $this->master_riwayat_jabatan = MasterRiwayatJabatan::create($data);
        $this->dispatchBrowserEvent('informations', "Data Jabatan Terakhir berhasil ditambahkan");  

        $this->subPage = 'list';
    }
}
