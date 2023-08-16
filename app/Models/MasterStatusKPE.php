<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStatusKPE extends Model
{
    use HasFactory;

    protected $table = 'master_kpe';

    protected $primaryKey = 'kkpe';

    protected $fillable = [
        'kkpe',
        'nkpe',
    ];

    public $timestamps = false;
}
