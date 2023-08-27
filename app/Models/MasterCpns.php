<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class MasterCpns extends Model
{
    use HasFactory;

    protected $table = 'master_cpns';

    protected $primaryKey = 'nip';
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'ntbakn',
        'tntbakn',
        'kpej',
        'skcpns',
        'tskcpns',
        'tmtcpns',
        'kgolru',
        'nsttpp',
        'tsttpp',
        'tmtlgas',
        'mskerjabl',
        'mskerjath',
        'file_skcpns',
        'srtsehattgl',
        'srtsehatno',
    ];

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
    }
}
