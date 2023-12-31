<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefJenPeg extends Model
{
    use HasFactory;

    protected $table = 'ref_jenpeg';

    protected $fillable = [
        'kjpeg',
        'njpeg'
    ];
}
