<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefJnsHukum extends Model
{
    use HasFactory;

    protected $table = 'ref_jns_hukum';

    public function nama_tipe_dok()
    {
        return $this->belongsTo(RefTipeDokHukum::class, 'id_jns_dok', 'id');
    }

    public function ndokhukum()
    {
        return $this->hasMany(DokHukum::class, 'id_jns_hukum', 'id');
    }

    protected $fillable = [
        'nama',
        'singkatan',
        'kode_file',
        'urutan',
        'id_jns_dok',
        'kategori_dok',
        'dasar_hukum',
        'stts',
        'crid',
        'upid'
    ];
}
