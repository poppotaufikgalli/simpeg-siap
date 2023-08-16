<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisWilayah extends Model
{
    use HasFactory;

    protected $table = 'master_wilayah';

    protected $primaryKey = 'kwil';

    protected $fillable = [
        'kwil',
        'nwil',
        'twil',
        'kprov',
        'kkab',
        'kkec',
        'tkdesa',
        'tdesa'
    ];

    public $timestamps = false;
}
