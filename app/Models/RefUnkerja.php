<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefUnkerja extends Model
{
    use HasFactory;

    protected $table = 'ref_unkerja';

    public function neselon()
    {
        return $this->belongsTo(MasterEselon::class, 'id_eselon', 'keselon');
    }
}
