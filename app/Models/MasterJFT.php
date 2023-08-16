<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MasterJFT extends Model
{
    use HasFactory;

    protected $table = 'master_jabatan_ft';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function nkeljab()
    {
        return $this->belongsTo(MasterKelJab::class, 'kel_jabatan_id');
    }

    public function njenjang()
    {
        return $this->belongsTo(MasterJenjangJafung::class, 'jenjang');
    }

    protected $fillable = [
        'id',
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
    }
}
