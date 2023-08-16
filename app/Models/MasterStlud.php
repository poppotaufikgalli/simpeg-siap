<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStlud extends Model
{
    use HasFactory;

    protected $table = 'master_stlud';

    protected $primaryKey = 'kstlud';

    protected $fillable = [
        'kstlud',
        'nstlud',
    ];

    public $timestamps = false;
}
