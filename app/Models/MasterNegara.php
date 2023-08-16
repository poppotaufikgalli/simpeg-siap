<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterNegara extends Model
{
    use HasFactory;

    protected $table = 'master_jabatan_negara';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nama',
    ];

    public $timestamps = false;
}
