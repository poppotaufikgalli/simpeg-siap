<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use DateTimeInterface;

class MasterRiwayatHukDis extends Model
{
    use HasFactory;

    protected $table = 'master_riwayat_hukdis';

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    public function njns()
    {
        return $this->belongsTo(MasterJenisHukdis::class, 'jhukum');
    }

    protected $fillable = [
        'nip',
        'jhukum',
        'deshukum',
        'nsk',
        'tsk',
        'kpej',
        'tmt',
        'selesai'
    ];

    public $timestamps = false;

    protected $dates = ['tsk', 'tmt', 'selesai'];

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
            $builder->orderByRaw('CONVERT(tmt, SIGNED) desc');
        });
    }
}
