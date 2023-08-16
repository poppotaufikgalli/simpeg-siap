<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

use App\Models\ListLampiran;
use App\Models\Menu;
use App\Models\RefTipeDokHukum;
use App\Models\RefJnsHukum;
use App\Models\VKonten;
use App\Models\VVisitor1;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function SIAPLogin($credentials)
    {
        $body = [
            'username' => $credentials['nip'],
            'password' => $credentials['password'],
        ];
        $response = Http::withHeaders(['token' => env('SIAP_REST_API_TOKEN')])->asForm()->post(env('SIAP_AUTH_API').'/loginUser', $body);
        return $response->object();
    }

    protected function SIAPUser($credentials)
    {
        $body = [
            'nip' => $credentials['nip'],
        ];
        $response = Http::withHeaders(['token' => env('SIAP_REST_API_TOKEN')])->asForm()->post(env('SIAP_AUTH_API').'/getPegawai', $body);
        return $response->object();
    }

    protected function getGroupLampiran($id_dok_hukum)
    {
        $listlampiran = ListLampiran::select('id','jns', 'judul', 'nama_file')->where('id_dok_hukum', $id_dok_hukum)->get();
        $lampiran = [];
        foreach ($listlampiran as $key => $value) {
            $lampiran[$value->jns][] = $value;
        }
        return $lampiran;
    }

    public function GetMenu(){
        return $this->getStrukturMenu();
    }

    public function GetTipeDokHukum()
    {
        //return RefTipeDokHukum::where('stts', 1)->get();
    }

    public function GetJnsDokHukum()
    {
        //return RefJnsHukum::where('stts', 1)->get();
    }

    public function GetLink()
    {
        $retval = [];
        /*$lsKat = ['', 'Daerah', 'Nasional', 'Internasional'];
        $dlink = VKonten::where('jns','l')->get();
        if(isset($dlink)){
            foreach ($dlink as $key => $value) {
                $kat = $lsKat[$value->kategori];
                $retval[$kat][] = $value;
            }
        }*/
        return $retval;
    }

    protected function getStrukturMenu($selKategori = 1){
        //$lsmenu = Menu::where('kategori', $selKategori)->get();
        $retmenu = [];
        $main = [];
        $sub = [];
        $listMenu = [];
        /*if($lsmenu){
            foreach ($lsmenu as $key => $value) {
                $ref = $value->ref;
                $id = $value->id;
                if($ref > 0){
                    $sub[$ref][] = $value;
                }
            }

            foreach ($lsmenu as $key => $value) {
                $ref = $value->ref;
                $id = $value->id;
                if($ref == 0){
                    if(isset($sub[$id])){
                        $value['sub'] = $sub[$id];
                    }
                    $main[] = $value;
                }
            }
        }*/

        return ['main' => $main, 'sub' => $sub];
    }

    public function getHal($w=''){
        $jns_hal = [
            'b' => 'berita',
            'h' => 'halaman',
            'g' => 'galeri kegiatan',
            'bh' => 'buku hukum',
            'br' => 'brosur',
            'j' => 'journal',
            'l' => 'link',
            'vt' => 'video testimoni',
            'vj' => 'videotron JDIH',
            'dg' => 'Data Grafik',
            'ih' => 'Infografis Hukum',
            'jk' => 'Jawaban Kami',
            'id' => 'Informasi Digital',
            'pb' => 'Pembelajaran Online',
            'ph' => 'Penghargaan',
            'qr' => 'QRCode',
        ];

        if($w==''){
            return $jns_hal;  
        }else{
            return $jns_hal[$w];
        }
    } 

    public function GetVisits(){
        //return VVisitor1::first();
    }
}
