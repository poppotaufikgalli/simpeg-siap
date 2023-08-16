<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCpns extends Model
{
    use HasFactory;

    protected $table = 'master_cpns';

    protected $primaryKey = 'nip';
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'ntbakn',
        'tntbakn',
        'kpej',
        'skcpns',
        'tskcpns',
        'tmtcpns',
        'kgolru',
        'nsttpp',
        'tsttpp',
        'tmtlgas',
        'mskerjabl',
        'mskerjath',
        'file_skcpns',
        'srtsehattgl',
        'srtsehatno'
    ];

    public $timestamps = false;
}
