<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPejabat extends Model
{
    use HasFactory;

    protected $table = "master_pejabat";

    protected $primaryKey = 'kpej';

    protected $fillable = [
        'kpej',
        'npej',
    ];

    public $timestamps = false;
}
