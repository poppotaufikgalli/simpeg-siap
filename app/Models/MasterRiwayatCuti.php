<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use DateTimeInterface;

class MasterRiwayatCuti extends Model
{
    use HasFactory;

    protected $table = 'master_riwayat_cuti';

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    public function njns()
    {
        return $this->belongsTo(MasterJenisCuti::class, 'jcuti');
    }

    protected $fillable = [
        'nip',
        'jcuti',
        'nsk',
        'tsk',
        'thn',
        'tmulai',
        'tkahir',
        'ptetap',
        'jmlhari',
    ];

    public $timestamps = false;

    protected $dates = ['tsk', 'tmulai', 'takhir'];

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

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderByRaw('CONVERT(tmulai, SIGNED) desc');
        });
    }
}
