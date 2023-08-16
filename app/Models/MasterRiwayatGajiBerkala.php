<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MasterRiwayatGajiBerkala extends Model
{
    use HasFactory;

    protected $table = 'master_riwayat_gajiberkala';

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    /*public function npangkat()
    {
        return $this->belongsTo(MasterPangkat::class, 'kgolru');
    }*/

    protected $fillable = [
        'nip',
        'nstahu',
        'tstahu',
        'tmtngaj',
        'gpokkhir',
        'kkantor',
        'mskerja',
        'mskerjabl',
        'kpej',
        'akhir',
        'id_opd',
        'nunker',
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

        //static::addGlobalScope('order', function (Builder $builder) {
        //    $builder->orderByRaw('CONVERT(id, SIGNED) asc');
        //});
    }
}
