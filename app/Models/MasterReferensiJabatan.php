<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MasterReferensiJabatan extends Model
{
    use HasFactory;

    protected $table = 'master_referensi_jabatan';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    /*public function npangkat()
    {
        return $this->belongsTo(MasterPangkat::class, 'kgolru');
    }*/

    protected $fillable = [
        'id',
        'jenis_jabatan_id',
        'nama',
        'bup_usia',
        'kel_jabatan_id',
        'jenjang',
        'status',
        'cepat_kode',
        'ref_simpeg',
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

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderByRaw('CONVERT(id, SIGNED) asc');
        });
    }
}
