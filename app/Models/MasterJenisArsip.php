<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MasterJenisArsip extends Model
{
    use HasFactory;

    protected $table = 'master_jenis_arsip';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function ngrDok()
    {
        return $this->belongsTo(MasterGroupArsip::class, 'group_arsip_id');
    }

    protected $fillable = [
        'id',
        'nama',
        'group_arsip_id',
        'jnsdok',
        'riw',
        'order_by',
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
