<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'group';

    public function nakses()
    {
        return $this->hasMany(Akses::class, 'gid');
    }

    protected $fillable = [
        'nama',
        'lsakses',
        'crid',
        'upid',
    ];
}
