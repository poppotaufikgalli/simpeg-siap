<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'master_pegawai';

    protected $primaryKey = 'nip';
    protected $keyType = 'string';

    /*public function neselon()
    {
        return $this->belongsTo(MasterEselon::class, 'id_eselon');
    }*/

    protected $fillable = [
        'nip',
        'nama',
        'gldepan',
        'glblk',
        'ktlahir',
        'tlahir',
        'kjkel',
        'kagama',
        'kstatus',
        'kjpeg',
        'kduduk',
        'kskawin',
        'kgoldar',
        'aljalan',
        'alrt',
        'alrw',
        'altelp',
        'alkoprop',
        'alkokab',
        'alkokec',
        'alkodes',
        'kpos',
        'kaparpol',
        'npap_g',
        'nkarpeg',
        'naskes',
        'ntaspen',
        'nkaris_su',
        'npwp',
        'nik', //nopen
        'file_bmp',
        'aktif',
        'jjiwa',
        'marga',
        'suku',
        'tgl_peg',
        'niplama',
        //'nip18',
        //'nunker',
        'stat_kpe',
        'tgl_reg',
        'no_pinpeg',
        'alkoproplahir',
        'alkokablahir',
        'tgl_kpe',
        'thn_pendataan',
        'no_ref_bkn',
        'email',
        'id_jenis_personel',
        'id_opd',
        'id_sub_opd'
    ];

    public $timestamps = false;
}
