<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use DateTimeInterface;

class MasterRiwayatTumlar extends Model
{
    use HasFactory;

    protected $table = 'master_riwayat_tumlar';

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    public function npej()
    {
        return $this->belongsTo(MasterPejabat::class, 'ptetap');
    }

    public function ntpu()
    {
        return $this->belongsTo(MasterTingkatPendidikan::class, 'ktpu');
    }

    public function njur()
    {
        return $this->belongsTo(MasterPendidikan::class, 'kjur');
    }

    protected $fillable = [
        'nip',
        'ptetap',
        'nsk',
        'tsk',
        'ktpu',
        'kjur',
        'gldepan',
        'glblk',
    ];

    public $timestamps = false;

    protected $dates = ['tsk'];

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
            $builder->orderBy('tsk','desc');
        });
    }
}
