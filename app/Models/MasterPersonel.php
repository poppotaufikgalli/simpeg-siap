<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class MasterPersonel extends Model
{
    use HasFactory;
    protected $table = "vpersonel";

    protected $dates = ['tlahir', 'tmtjab'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
