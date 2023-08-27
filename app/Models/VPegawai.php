<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class VPegawai extends Model
{
    use HasFactory;

    protected $table = "VPegawai";

    /*protected $dates = ['tmulai', 'takhir', 'tsttpp'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }*/
}
