<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPns extends Model
{
    use HasFactory;

    protected $table = 'master_pns';

    protected $primaryKey = 'nip';
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'kpej',
        'skpns',
        'tskpns',
        'tmtpns',
        'kgolru',
        'kjpns',
        'file_skpns',
    ];

    public $timestamps = false;
}
