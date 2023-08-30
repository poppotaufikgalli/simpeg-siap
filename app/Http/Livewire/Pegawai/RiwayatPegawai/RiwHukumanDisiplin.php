<?php

namespace App\Http\Livewire\Pegawai\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatHukDis;
use App\Models\MasterJenisHukdis;
use App\Models\MasterPejabat;
use App\Models\MasterJenisArsip;

class RiwHukumanDisiplin extends Component
{
    public $sid;
    public $subPage = 'list';
    public $lblAkhir = "Ya";

    public $next;
    public $method;
    public $dataset = [];
    public $arsip = [];

    public $tmt;
    public $master_jenis_arsip = [];

    protected $listeners = ["tambah", "tutup", "edit", "delete", "callModal"];

    public function callModal($njns, $jhukum, $tmt){
        //$type, $name, $hash, $table, $key
        //$hash = preg_replace("![^a-z0-9]+!i", "-", strtolower($nama_jkeluarga));
        $name = $jhukum .'_'. date('d-m-Y',strtotime($tmt));
        $this->emitTo('modal-upload-arsip-personel', 'openModalPersonel', $njns, $name, 'riw-hukuman-disiplin', 'master_riwayat_hukdis', [
            'nip' => $this->sid,
            'tmt' => $tmt,
        ]);
    }

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'tmt' => [
                'required',
                Rule::unique('master_riwayat_hukdis')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmt', '=', $data['tmt']);
                }),
            ],
        ],[
            'tmt.required' => 'TMT Hukuman Disiplin tidak boleh kosong',
            'tmt.unique' => 'TMT Hukuman Disiplin Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatHukDis::create($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Hukuman Disiplin berhasil ditambahkan");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'tmt' => [
                'required',
                Rule::unique('master_riwayat_hukdis')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmt', '=', $data['tmt']);
                })->ignore($this->sid,'nip')->ignore($this->tmt,'tmt'),
            ],
        ],[
            'tmt.required' => 'TMT Hukuman Disiplin tidak boleh kosong',
            'tmt.unique' => 'TMT Hukuman Disiplin Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatHukDis::where('nip', '=', $this->sid)->where('tmt', '=', $this->tmt)->update($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Hukuman Disiplin berhasil diubah");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }
    
    public function render()
    {
        $retData = MasterRiwayatHukDis::where('nip', '=', $this->sid)->get();

        return view('livewire.pegawai.riwayat-pegawai.riw-hukuman-disiplin', [
            'master_riwayat_hukdis' => $retData,
            'master_jenis_hukdis' => MasterJenisHukdis::all(),
            'master_pejabat' => MasterPejabat::all()
            //'master_pangkat' => MasterPangkat::all(),
        ]);
    }

    public function mount(){
        $this->dataset['nip'] = $this->sid;
    }

    public function tambah()
    {
        $this->subPage = 'formulir';
        $this->next = "store";
    }

    public function tutup()
    {
        $this->subPage = 'list';
        $this->dataset = [];
        $this->dataset['nip'] = $this->sid;
    }

    public function edit($value)
    {
        $this->subPage = 'formulir';
        $this->next = "update";

        $dataset = MasterRiwayatHukDis::where('nip', '=', $this->sid)->where('tmt', '=', $value['tmt'])->first();

        if($dataset){
            $this->tmt = $value['tmt'];
            $this->getMasterArsip('hukuman'.str_replace(' ', '_', $dataset['nsk']), "Hukuman Disiplin : ".$dataset['nsk']);
            $this->dataset = $dataset->toArray();
        }else{
            $this->dataset['nip'] = $this->sid;
        }
    }

    public function getMasterArsip($jns, $nama)
    {
        $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'hukuman')->get();
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
        $del = MasterRiwayatHukDis::where('nip', '=', $this->sid)->where('tmt', '=', $value['tmt'])->delete();
        //dd($del);
        //$del->delete();      
        
        $this->dispatchBrowserEvent('informations', "Data Riwayat Hukuman Disiplin berhasil dihapus");  
    }
}
