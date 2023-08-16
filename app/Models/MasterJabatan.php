<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MasterJabatan extends Model
{
    use HasFactory;

    protected $table = 'master_formasi_jabatan';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function neselon()
    {
        return $this->belongsTo(MasterEselon::class, 'id_eselon');
    }

    public function njns_jab()
    {
        return $this->belongsTo(MasterJenisJabatan::class, 'id_jenis_jabatan');
    }

    public function nopd()
    {
        return $this->belongsTo(MasterOPD::class, 'id_opd');
    }

    protected $fillable = [
        'id',
        'parent_id',
        'id_opd',
        'nama',
        'id_eselon',
        'id_jenis_jabatan',
        'ref_jabatan_id',
        'kelas_jabatan',
        'nilai_jabatan',
        'indeks_jabatan',
        'status_jabatan',
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
