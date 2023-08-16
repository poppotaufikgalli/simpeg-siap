<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJabStr extends Model
{
    use HasFactory;

    protected $table = 'master_jabatan_str';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nama',
    ];

    public $timestamps = false;
}
