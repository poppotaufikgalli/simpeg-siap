<?php

namespace App\Http\Livewire\Pegawai\RiwayatPendidikan;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatPendum;
use App\Models\MasterTingkatPendidikan;
use App\Models\MasterPendidikan;
use App\Models\MasterPejabat;
use App\Models\MasterJenisArsip;

class Pendum extends Component
{
    public $sid;
    public $subPage = 'list';
    public $lblStts = "Tidak";

    public $next;
    public $method;
    public $dataset = [];
    public $arsip = [];

    public $kjur;
    public $ktpu;
    public $master_jenis_arsip = [];

    public $master_pendidikan = [];

    protected $listeners = ["tambah", "tutup", "edit", "delete", "callModal"];

    public function callModal($idx, $ktpu, $kjur){
        $hash = preg_replace("![^a-z0-9]+!i", "-", strtolower($ktpu));
        $this->emitTo('modal-upload-arsip-personel', 'openModalPersonel', $ktpu, $idx, $hash, 'master_riwayat_pendum', [
            'nip' => $this->sid,
            'ktpu' => $ktpu,
            'kjur' => $kjur,
        ]);
    }

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'ktpu' => [
                'required',
                Rule::unique('master_riwayat_pendum')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('ktpu', '=', $data['ktpu'])
                        ->where('kjur', '=', $data['kjur']);
                }),
            ],
            'kjur' => [
                'required',
                Rule::unique('master_riwayat_pendum')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('ktpu', '=', $data['ktpu'])
                        ->where('kjur', '=', $data['kjur']);
                }),
            ],
        ],[
            'ktpu.required' => 'Tingkat Pendidikan tidak boleh kosong',
            'ktpu.unique' => 'Tingkat Pendidikan Telah Terdaftar',
            'kjur.required' => 'Jurusan Pendidikan tidak boleh kosong',
            'kjur.unique' => 'Jurusan Pendidikan Telah Terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        if(isset($data['akhir']) && $data['akhir'] == true){
            MasterRiwayatPendum::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);    
        }

        MasterRiwayatPendum::create($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Pendidikan Umum berhasil ditambahkan");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'ktpu' => [
                'required',
                Rule::unique('master_riwayat_pendum')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('ktpu', '=', $data['ktpu'])
                        ->where('kjur', '=', $data['kjur']);
                })->ignore($this->sid, 'nip')->ignore($this->ktpu, 'ktpu')->ignore($this->kjur, 'kjur'),
            ],
            'kjur' => [
                'required',
                Rule::unique('master_riwayat_pendum')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('ktpu', '=', $data['ktpu'])
                        ->where('kjur', '=', $data['kjur']);
                })->ignore($this->sid, 'nip')->ignore($this->ktpu, 'ktpu')->ignore($this->kjur, 'kjur'),
            ],
        ],[
            'ktpu.required' => 'Tingkat Pendidikan tidak boleh kosong',
            'ktpu.unique' => 'Tingkat Pendidikan Telah Terdaftar',
            'kjur.required' => 'Jurusan Pendidikan tidak boleh kosong',
            'kjur.unique' => 'Jurusan Pendidikan Telah Terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        if(isset($data['akhir']) && $data['akhir'] == true){
            MasterRiwayatPendum::where('nip', '=', $this->sid)->where('akhir', '=', 1)->update([
                'akhir' => 0,
            ]);    
        }

        MasterRiwayatPendum::where('nip', '=', $this->sid)->where('ktpu', '=', $this->ktpu)->where('kjur', '=', $this->kjur)->update($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Pendidikan Umum berhasil diubah");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }
    
    public function render()
    {
        $retData = MasterRiwayatPendum::where('nip', '=', $this->sid)->get();

        return view('livewire.pegawai.riwayat-pendidikan.pendum', [
            'master_riwayat_pendum' => $retData,
            'master_tingkat_pendidikan' => MasterTingkatPendidikan::all(),
            //'master_pendidikan' => MasterPendidikan::where('status', '=', 1)->get(),
            'master_pejabat' => MasterPejabat::all()
            //'master_pangkat' => MasterPangkat::all(),
        ]);
    }

    public function changeJur($selId)
    {
        $dt = MasterTingkatPendidikan::find($selId);
        $sel = explode(',', $dt->ref_simpeg);
        $this->master_pendidikan = MasterPendidikan::where('status', '=', 1)->where(function($query) use($sel){
            foreach ($sel as $key => $value) {
                $query->orWhere('tk_pendidikan_id', '=', intval($value));
            }
        })->orderBy('nama')->get();
    }

    public function changeStts($selId)
    {
        $this->lblStts = $selId == 1 ? "Ya" : "Tidak";
    }

    public function mount(){
        $this->dataset['nip'] = $this->sid;
    }

    public function tambah()
    {
        $this->dispatchBrowserEvent('tomSelectActive');
        $this->subPage = 'formulir';
        $this->next = "store";
        $this->dataset['negara'] = "INDONESIA";
    }

    public function tutup()
    {
        $this->subPage = 'list';
        $this->dataset = [];
        $this->dataset['nip'] = $this->sid;

        $this->dataset['negara'] = "INDONESIA";
    }

    public function edit($value)
    {
        //dd($value);
        $this->dispatchBrowserEvent('tomSelectActive');

        $this->subPage = 'formulir';
        $this->next = "update";

        $dataset = MasterRiwayatPendum::where('nip', '=', $this->sid)->where('ktpu', '=', $value['ktpu'])->where('kjur', '=', $value['kjur'])->first();

        if($dataset){
            $this->ktpu = $value['ktpu'];
            $this->kjur = $value['kjur'];
            $this->changeStts($dataset['akhir']);
            $this->changeJur($dataset['ktpu']);
            $this->dataset = $dataset->toArray();
            $this->getMasterArsip('pendum_'.$dataset['ktpu'], "Pendidikan Umum : ".$dataset['ntpu']->nama);
        }else{
            $this->dataset['nip'] = $this->sid;
        }

        $this->dataset['negara'] = "INDONESIA";
    }

    public function getMasterArsip($jns, $nama)
    {
        $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'pendum')->get();
        if($master_jenis_arsip){
            foreach ($master_jenis_arsip as $key => $value) {
                $value->jnsdok = $jns;
                $value->nama = $nama;
            }
            $this->master_jenis_arsip = $master_jenis_arsip;
        }
    }

    public function delete($value)
    {
        $del = MasterRiwayatPendum::where('nip', '=', $this->sid)->where('ktpu', '=', $value['ktpu'])->where('kjur', '=', $value['kjur'])->delete();
        //dd($del);
        //$del->delete();      
        
        $this->dispatchBrowserEvent('informations', "Data Riwayat Pendidikan Umum berhasil dihapus");  
    }
}
