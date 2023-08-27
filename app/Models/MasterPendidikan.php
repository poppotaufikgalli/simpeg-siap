<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MasterPendidikan extends Model
{
    use HasFactory;

    protected $table = 'master_pendidikan';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function ntpu()
    {
        return $this->belongsTo(MasterTingkatPendidikan::class, 'tk_pendidikan_id', 'id');
    }

    protected $fillable = [
        'id',
        'tk_pendidikan_id',
        'nama',
        'status',
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
            $builder->orderBy('tk_pendidikan_id', 'asc');
            $builder->orderBy('nama', 'asc');
        });
    }
}
