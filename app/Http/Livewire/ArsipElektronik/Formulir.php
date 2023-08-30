<?php

namespace App\Http\Livewire\ArsipElektronik;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterJenisProfesi;
use App\Models\VPersonel;
use App\Models\MasterJenisArsip;
use App\Models\MasterGroupArsip;

use App\Models\MasterRiwayatPangkat;
use App\Models\MasterRiwayatJabatan;
use App\Models\MasterRiwayatPenghargaan;
use App\Models\MasterRiwayatDp3;
use App\Models\MasterRiwayatTumlar;
use App\Models\MasterRiwayatHukdis;
use App\Models\MasterRiwayatCuti;
use App\Models\MasterRiwayatOrganisasi;
use App\Models\MasterRiwayatPendum;
use App\Models\MasterRiwayatDiklat;
use App\Models\MasterRiwayatKeluarga;

use DB;

class Formulir extends Component
{
    public $sid;
    public $method;
    public $next;
    public $dataset;

    public $nama;
    public $judul;
    public $ket;
    public $group;

    protected $listeners = ['callModal'];

    public function callModal($filename)
    {
        $this->emitTo('modal-upload-arsip-personel', 'openFile', $filename);
    }

    public function render()
    {
        $retData0 = DB::table('master_jenis_arsip')
            ->leftjoin('master_pegawai_arsip', function ($join) {
                    $join->on('master_jenis_arsip.jnsdok','=','master_pegawai_arsip.jnsdok');
                    $join->on('master_pegawai_arsip.nip','=',DB::raw("'".$this->sid."'"));
                })
            ->select('master_pegawai_arsip.nip as nip', 'master_jenis_arsip.nama as judul',  DB::raw("'Identitas' as `group`"), 'master_jenis_arsip.jnsdok as ket', 'master_pegawai_arsip.filename as filename')
            ->get();
        $retData1 = DB::table('varsipelektronik')->where('nip', '=', $this->sid)->get();

        $retData = $retData0->merge($retData1);

        $lsgroup = ['Identitas', 'Pangkat', 'Jabatan', 'Penghargaan / Tanda Jasa', 'DP3 / P2KP / SKP', 'Pencantuman Gelar', 'Hukuman Disiplin', 'Cuti', 'Organisasi', 'Pendidikan Umum', 'Pendidikan Kepemimpinan', 'Pendidikan/Kursus', 'Keluarga'];
        return view('livewire.arsip-elektronik.formulir', [
            'lsArsip' => $retData,
            'lsGroup' => $lsgroup,
            'master_group_arsip' => MasterGroupArsip::all(),
        ]);
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = VPersonel::where('nip', '=', $this->sid)->first();

            if($dataset){
                $this->dataset = [
                    'nip' => $dataset->nip,
                    'nama' => $dataset->namapeg,
                ];
            }
        }   
    }
}
