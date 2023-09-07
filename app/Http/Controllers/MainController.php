<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterJenisPersonel;
use DB;

class MainController extends Controller
{
    function dashboard(){
        $jenis_personel = MasterJenisPersonel::select('id_jenis_personel')->where('stts', '=', 1)->get();

        $retData = DB::table('vpersonel')->select(
                DB::raw('(select COUNT(b.judul) FROM varsipelektronik b WHERE b.nip = vpersonel.nip and vpersonel.id_jenis_personel = 1) as jml1'), 
                //DB::raw('(select COUNT(b.judul) FROM varsipelektronik b WHERE b.nip = vpersonel.nip and vpersonel.id_jenis_personel = 2) as jml1b'), 
                DB::raw('(select COUNT(c.filename) FROM varsipelektronik c WHERE c.nip = vpersonel.nip) as jml2'),
                DB::raw('(select COUNT(d.jnsdok) FROM master_jenis_arsip d) as jml3'), 
                DB::raw('(select COUNT(e.jnsdok) FROM master_pegawai_arsip e JOIN master_jenis_arsip f on (e.jnsdok=f.jnsdok) WHERE e.nip = vpersonel.nip) as jml4')
            )->get();

        //dd($retData);
                        
        $a=0;
        $b=0;
        //$c=0;
        foreach ($retData as $key => $value) {
            //$a += ($value->jml1a + $value->jml3);
            //$b += ($value->jml1b + $value->jml3);
            //$c += ($value->jml2 + $value->jml4);
            $a += ($value->jml1 + $value->jml3);
            $b += ($value->jml2 + $value->jml4);
        }

        $arsip = [
            'ref' => $a,
            'jml'  => $b,
        ];

        return view("admin/dashboardPage", [
            'arsip' => $arsip,
        ]);
    }

    public function main(){
        echo $_ENV['APP_NAME'];
    }
}
