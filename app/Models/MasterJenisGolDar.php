<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisGolDar extends Model
{
    use HasFactory;

    protected $table = 'master_jenis_goldar';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama',
    ];

    public $timestamps = false;
}
