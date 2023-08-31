<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'master_pegawai';

    protected $primaryKey = 'nip';
    protected $keyType = 'string';

    /*public function neselon()
    {
        return $this->belongsTo(MasterEselon::class, 'id_eselon');
    }*/

    protected $fillable = [
        'nip',
        'nama',
        'gldepan',
        'glblk',
        'ktlahir',
        'tlahir',
        'kjkel',
        'kagama',
        'kstatus',
        'kjpeg',
        'kduduk',
        'id_korps',
        'korps',
        'id_kejuruan',
        'kejuruan',
        'kskawin',
        'kgoldar',
        'aljalan',
        'alrt',
        'alrw',
        'altelp',
        'alkoprop',
        'alprop',
        'alkokab',
        'alkab',
        'alkokec',
        'alkec',
        'alkodes',
        'aldes',
        'stts_rumah',
        'kpos',
        'kaparpol',
        'npap_g',
        'nkarpeg',
        'naskes',
        'ntaspen',
        'nkaris_su',
        'npwp',
        'nik', //nopen
        'file_bmp',
        'aktif',
        'jjiwa',
        'marga',
        'suku',
        'tgl_peg',
        'niplama',
        //'nip18',
        //'nunker',
        'stat_kpe',
        'tgl_reg',
        'no_pinpeg',
        'alkoproplahir',
        'alkokablahir',
        'tgl_kpe',
        'thn_pendataan',
        'no_ref_bkn',
        'email',
        'id_jenis_personel',
        'id_opd',
        'id_sub_opd'
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
            $builder->orderBy('tlahir', 'asc');
            //$builder->orderBy('nama', 'asc');
        });
    }
}
