<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPegawaiArsip extends Model
{
    use HasFactory;

    protected $table = "master_pegawai_arsip";
    //protected $primaryKey = 'nip';
    //protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nip',
        'jnsdok',
        'filename',
        'caption',
        'page_id',
        'flag',
        'userid',
        'tgl_upload'
    ];

    public $timestamps = false;
}
