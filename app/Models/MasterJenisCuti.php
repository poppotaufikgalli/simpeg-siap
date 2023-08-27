<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisCuti extends Model
{
    use HasFactory;

    protected $table = 'master_jenis_cuti';

    //protected $primaryKey = 'id';
    //public $incrementing = false;
    //protected $keyType = 'string';

    //public function njns()
    //{
    //    return $this->belongsTo(MasterJenisCuti::class, 'jcuti');
    //}

    protected $fillable = [
        'id',
        'nama',
    ];

    public $timestamps = false;
}
