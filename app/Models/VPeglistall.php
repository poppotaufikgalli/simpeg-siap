<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VPeglistall extends Model
{
    use HasFactory;

    protected $table = 'v_peglistall';

    protected static function booted()
    {
        static::addGlobalScope(fn ($query) => $query->orderByRaw('kgolru desc, id_eselon asc, masath desc, masabl desc, ktpu desc, usiath desc'));
    }
}
