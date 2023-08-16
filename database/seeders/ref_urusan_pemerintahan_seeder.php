<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ref_urusan_pemerintahan_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_urusan_pemerintahan')->insert([
            [
                'nama' => 'Pendidikan',
                'jns' => 1,
                'crid' => 1
            ],[
                'nama' => 'Kesehatan',
                'jns' => 1,
                'crid' => 1
            ],[
                'nama' => 'Pekerjaan Umum dan Penataan Ruang',
                'jns' => 1,
                'crid' => 1
            ],[
                'nama' => 'Perumahan Rakyat dan Kawasan Permukiman',
                'jns' => 1,
                'crid' => 1
            ],[
                'nama' => 'Ketentraman, Ketertiban umum dan Perlindungan Masyarakat',
                'jns' => 1,
                'crid' => 1
            ],[
                'nama' => 'Sosial',
                'jns' => 1,
                'crid' => 1
            ],[
                'nama' => 'Tenaga Kerja',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Pemberdayaan Perempuan dan Perlindungan Anak',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Pangan',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Pertanahan',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Lingkungan Hidup',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Administrasi Kependudukan dan Pencatatan Sipil',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Pemberdayaan Masyarakat Desa',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Pengendalian Kependudukan dan Keluarga Berencana',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Perhubungan',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Komunikasi dan Informatika',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Koperasi, Usaha Kecil dan Menengah',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Penanaman Modal',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Kepemudaan dan Olah Raga',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Statistik',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Persandian',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Kebudayaan',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Perpustakaan',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Kearsipan',
                'jns' => 2,
                'crid' => 1
            ],[
                'nama' => 'Kelautan dan Perikanan',
                'jns' => 10,
                'crid' => 1
            ],[
                'nama' => 'Pariwisata',
                'jns' => 10,
                'crid' => 1
            ],[
                'nama' => 'Pertanian',
                'jns' => 10,
                'crid' => 1
            ],[
                'nama' => 'Kehutanan',
                'jns' => 10,
                'crid' => 1
            ],[
                'nama' => 'Energi dan Sumber Daya Mineral',
                'jns' => 10,
                'crid' => 1
            ],[
                'nama' => 'Perdagangan',
                'jns' => 10,
                'crid' => 1
            ],[
                'nama' => 'Perindustrian',
                'jns' => 10,
                'crid' => 1
            ],[
                'nama' => 'Transmigrasi',
                'jns' => 10,
                'crid' => 1
            ]
        ]);
    }
}
