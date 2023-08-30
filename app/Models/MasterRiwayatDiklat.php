<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTimeInterface;

class MasterRiwayatDiklat extends Model
{
    use HasFactory;

    protected $table = 'master_riwayat_diklat';

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    public function njdiklat()
    {
        return $this->belongsTo(MasterJenisDiklat::class, 'jdiklat');
    }

    protected $fillable = [
        'nip',
        'jdiklat',
        'kdiklat',
        'ndiklat',
        'tempat',
        'pan',
        'sebagai',
        'angkatan',
        'tmulai',
        'takhir',
        'jam',
        'nsttpp',
        'tsttpp',
        'akhir',
    ];

    protected $dates = ['tmulai', 'takhir', 'tsttpp'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public $timestamps = false;

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            $model->updated_by = NULL;
        });

        static::updating(function ($model) {
            $model->updated_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            $model->updated_at = Carbon::now();
        });

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('jdiklat', 'asc');
        });
    }
}
