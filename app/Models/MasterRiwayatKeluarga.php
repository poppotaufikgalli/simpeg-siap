<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTimeInterface;

class MasterRiwayatKeluarga extends Model
{
    use HasFactory;

    protected $table = 'master_riwayat_keluarga';

    protected $primaryKey = 'nip';
    //protected $incrementing = false;
    protected $keyType = 'string';

    public function nkerja()
    {
        return $this->belongsTo(MasterPekerjaan::class, 'kkerja');
    }

    public function njkeluarga()
    {
        return $this->belongsTo(MasterJenisKeluarga::class, 'jkeluarga');
    }

    protected $fillable = [
        "nip",
        "jkeluarga",
        "nama_kel",
        "ktlahir",
        "tlahir",
        "tijazah",
        "tkawin",
        "stunj",
        "kjkel",
        "kkerja",
        "nkerja",
        "instansi",
        "nip_kel",
        "hubkel",
        "akhir",
        "aljalan",
        "alrt",
        "alrw",
        "wil",
    ];

    public $timestamps = false;

    protected $dates = ['tlahir', 'tkawin'];

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

        //static::addGlobalScope('order', function (Builder $builder) {
        //    $builder->orderByRaw('CONVERT(id, SIGNED) asc');
        //});
    }
}
