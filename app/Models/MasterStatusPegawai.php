<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStatusPegawai extends Model
{
    use HasFactory;

    protected $table = 'master_status_pegawai';

    protected $primaryKey = 'id_status_pegawai';

    protected $fillable = [
        'id_status_pegawai',
        'kstatus',
        'nama',
        'persentase',
    ];

    public $timestamps = false;
}
