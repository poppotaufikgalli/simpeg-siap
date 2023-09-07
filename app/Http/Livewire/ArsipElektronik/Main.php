<?php

namespace App\Http\Livewire\ArsipElektronik;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\VPegawai;
use DB;

class Main extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $id_jenis_personel;
    
    public function render()
    {
        $retData = DB::table('vpersonel')
            ->select(
                'vpersonel.nip', 
                'vpersonel.namapeg', 
                DB::raw("'Identitas' as `group`"),
                DB::raw('(select COUNT(b.judul) FROM varsipelektronik b WHERE b.nip = vpersonel.nip) as jml1'), 
                DB::raw('(select COUNT(c.filename) FROM varsipelektronik c WHERE c.nip = vpersonel.nip) as jml2'),
                DB::raw('(select COUNT(d.jnsdok) FROM master_jenis_arsip d) as jml3'), 
                DB::raw('(select COUNT(e.jnsdok) FROM master_pegawai_arsip e JOIN master_jenis_arsip f on (e.jnsdok=f.jnsdok) WHERE e.nip = vpersonel.nip) as jml4')
            )->where('id_jenis_personel', '=', $this->id_jenis_personel)->get();
        
        $this->resetPage();

        return view('livewire.arsip-elektronik.main', [
            'master_pegawai' => $retData,
        ]);
    }
}
