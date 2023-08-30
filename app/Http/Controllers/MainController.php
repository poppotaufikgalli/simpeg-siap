<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MainController extends Controller
{
    function dashboard(){
        $retData = DB::table('vpersonel')->select(
                'vpersonel.nip', 
                'vpersonel.namapeg', 
                DB::raw("'Identitas' as `group`"),
                DB::raw('(select COUNT(b.judul) FROM varsipelektronik b WHERE b.nip = vpersonel.nip) as jml1'), 
                DB::raw('(select COUNT(c.filename) FROM varsipelektronik c WHERE c.nip = vpersonel.nip) as jml2'),
                DB::raw('(select COUNT(d.jnsdok) FROM master_jenis_arsip d) as jml3'), 
                DB::raw('(select COUNT(e.jnsdok) FROM master_pegawai_arsip e JOIN master_jenis_arsip f on (e.jnsdok=f.jnsdok) WHERE e.nip = vpersonel.nip) as jml4')
            )->get();
                        
        $a=0;
        $b=0;
        foreach ($retData as $key => $value) {
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
