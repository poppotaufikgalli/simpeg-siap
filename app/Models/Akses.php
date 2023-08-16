<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'hak_akses';

    public function groups()
    {
        return $this->belongsTo(Group::class, 'gid', 'id');
    }

    protected $fillable = [
        'nip',
        'nama',
        'uid',
        'gid',
        'crid',
        'upid'
    ];
}
