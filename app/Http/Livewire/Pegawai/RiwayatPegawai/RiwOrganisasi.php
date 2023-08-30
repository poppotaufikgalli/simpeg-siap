<?php

namespace App\Http\Livewire\Pegawai\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatOrganisasi;
use App\Models\MasterJenisOrganisasi;
use App\Models\MasterPejabat;
use App\Models\MasterJenisArsip;

class RiwOrganisasi extends Component
{
    public $sid;
    public $subPage = 'list';
    public $lblAkhir = "Ya";

    public $next;
    public $method;
    public $dataset = [];
    public $arsip = [];

    public $tmulai;
    public $master_jenis_arsip = [];

    protected $listeners = ["tambah", "tutup", "edit", "delete", "callModal"];

    public function callModal($norg, $jborg, $tmulai){
        //$type, $name, $hash, $table, $key
        //$hash = preg_replace("![^a-z0-9]+!i", "-", strtolower($nama_jkeluarga));
        $name = $jborg .'_'. date('d-m-Y',strtotime($tmulai));
        $this->emitTo('modal-upload-arsip-personel', 'openModalPersonel', $norg, $name, 'riw-organisasi', 'master_riwayat_organisasi', [
            'nip' => $this->sid,
            'norg' => $norg,
            'jborg' => $jborg,
            'tmulai' => $tmulai,
        ]);
    }

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
             'tmulai' => [
                'required',
                Rule::unique('master_riwayat_organisasi')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmulai', '=', $data['tmulai']);
                }),
            ],
            'norg' => 'required',
            'jborg' => 'required',
        ],[
            'tmulai.required' => 'Tanggal Mulai Organisasi tidak boleh kosong',
            'tmulai.return' => 'Tanggal Mulai Organisasi Telah terdaftar',
            'norg.required' => 'Nama Organisasi tidak boleh kosong',
            'jborg.required' => 'Jenis Keanggotaan Organisasi tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        //dd($data);

        MasterRiwayatOrganisasi::create($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Organisasi berhasil ditambahkan");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'tmulai' => [
                'required',
                Rule::unique('master_riwayat_organisasi')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmulai', '=', $data['tmulai']);
                })->ignore($this->sid,'nip')->ignore($this->tmulai,'tmulai'),
            ],
            'norg' => 'required',
            'jborg' => 'required',
        ],[
            'tmulai.required' => 'Tanggal Mulai Organisasi tidak boleh kosong',
            'tmulai.return' => 'Tanggal Mulai Organisasi Telah terdaftar',
            'norg.required' => 'Nama Organisasi tidak boleh kosong',
            'jborg.required' => 'Jenis Keanggotaan Organisasi tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatOrganisasi::where('nip', '=', $this->sid)->where('tmulai', '=', $this->tmulai)->update($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Organisasi berhasil diubah");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }
    
    public function render()
    {
        $retData = MasterRiwayatOrganisasi::where('nip', '=', $this->sid)->get();

        return view('livewire.pegawai.riwayat-pegawai.riw-organisasi', [
            'master_riwayat_organisasi' => $retData,
            'master_jenis_organisasi' => MasterJenisOrganisasi::all(),
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
        //dd($value);

        $this->subPage = 'formulir';
        $this->next = "update";

        $dataset = MasterRiwayatOrganisasi::where('nip', '=', $this->sid)->where('tmulai', '=', $value['tmulai'])->first();

        if($dataset){
            $this->tmulai = $value['tmulai'];
            //$this->nsk = $value['nsk'];
            $this->getMasterArsip('org_'.$dataset['tmulai']->format('Ymd'), "Organisasi : ".$dataset['norg']);
            $this->dataset = $dataset->toArray();
        }else{
            $this->dataset['nip'] = $this->sid;
        }
    }

    public function getMasterArsip($jns, $nama)
    {
        $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'org')->get();
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
        $del = MasterRiwayatOrganisasi::where('nip', '=', $this->sid)->where('tmulai', '=', $value['tmulai'])->delete();
        //dd($del);
        //$del->delete();      
        
        $this->dispatchBrowserEvent('informations', "Data Riwayat Organisasi berhasil dihapus");  
    }
}
