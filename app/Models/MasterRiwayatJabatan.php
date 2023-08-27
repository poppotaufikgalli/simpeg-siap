<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTimeInterface;

class MasterRiwayatJabatan extends Model
{
    use HasFactory;

    protected $table = 'master_riwayat_jabatan';

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    public function neselon()
    {
        return $this->belongsTo(MasterEselon::class, 'keselon');
    }

    public function nopd()
    {
        return $this->belongsTo(MasterOPD::class, 'id_opd', 'id');
    }

    protected $fillable = [
        'nip',
        'tmtjab',
        'kjab',
        'jnsjab',
        'keselon',
        'njab',
        'sjab',
        'nunker',
        'kpej',
        'nskjabat',
        'tskjabat',
        'nlantik',
        'tlantik',
        'id_instansi',
        'nama_instansi',
        'id_opd',
        'id_sub_opd',
        'akhir',
    ];

    public $timestamps = false;

    protected $dates = ['tmtjab', 'tlantik', 'tskjabat'];

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
            $builder->orderBy('tmtjab', 'desc');
        });
    }
}
