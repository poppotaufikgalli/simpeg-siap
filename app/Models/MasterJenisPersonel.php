<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisPersonel extends Model
{
    use HasFactory;

    protected $table = 'master_jenis_personel';

    protected $primaryKey = 'id_jenis_personel';

    protected $fillable = [
        'id_jenis_personel',
        'nama',
        'stts',
    ];

    public $timestamps = false;
}
