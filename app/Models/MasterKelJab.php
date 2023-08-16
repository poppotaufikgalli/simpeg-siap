<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MasterKelJab extends Model
{
    use HasFactory;

    protected $table = 'master_kelompok_jabatan';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function njnsJabUmum()
    {
        return $this->belongsTo(MasterJenisJabUmum::class, 'jenis_jabatan_id');
    }

    public function nrumpun()
    {
        return $this->belongsTo(MasterRumpunJafung::class, 'rumpun_jabatan_id');
    }

    public function npembina()
    {
        return $this->belongsTo(MasterInstansi::class, 'pembina_id');
    }

    protected $fillable = [
        'id',
        'nama',
        'jenis_jabatan_id',
        'rumpun_jabatan_id',
        'pembina_id',
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
