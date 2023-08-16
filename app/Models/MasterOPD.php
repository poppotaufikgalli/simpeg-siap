<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class MasterOPD extends Model
{
    use HasFactory;

    protected $table = 'master_opd';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function neselon()
    {
        return $this->belongsTo(MasterEselon::class, 'id_eselon');
    }

    protected $fillable = [
        'id',
        'parent_opd',
        'nama',
        'id_eselon',
        'alamat',
        'status',
        'disingkat',
        'sfilter',
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
