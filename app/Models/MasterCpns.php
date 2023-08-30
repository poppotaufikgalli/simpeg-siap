<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use DateTimeInterface;

class MasterCpns extends Model
{
    use HasFactory;

    protected $table = 'master_cpns';

    protected $primaryKey = 'nip';
    protected $keyType = 'string';

    public function npangkat()
    {
        return $this->belongsTo(MasterPangkat::class, 'kgolru');
    }

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
        'filename',
        'srtsehattgl',
        'srtsehatno',
    ];

    public $timestamps = false;

    protected $dates = ['tskcpns', 'tmtcpns', 'tntbakn', 'tsttpp', 'tmtlgas', 'srtsehattgl'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

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
