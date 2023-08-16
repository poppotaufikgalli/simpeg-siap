<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'username' => 'Taufik',
            'nip' => '198602162008031001',
            'stts' => 1,
            'crid' => 1
        ]);

        DB::table('ref_tipe_dok_hukum')->insert([
            [
                'nama' => 'Peraturan Perundang-undangan',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'Monografi Hukum',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'Artikel Hukum (majalah, koran)',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'Putusan Pengadilan/Yurisprudensi',
                'singkatan' => '',
                'crid' => 1
            ]
        ]);

        DB::table('ref_jns_hukum')->insert([
            [
                'nama' => 'Undang-Undang Dasar 1945',
                'singkatan' => 'UUD 1945',
                'kategori_dok' => 'P',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Ketetapan Majelis Permusyawaratan Rakyat',
                'singkatan' => 'TAP MPR',
                'kategori_dok' => 'P',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Undang-Undang',
                'singkatan' => 'UU',
                'kategori_dok' => 'P',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Undang-Undang Darurat',
                'singkatan' => 'UU Darurat',
                'kategori_dok' => 'P',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Peraturan Pemerintah Pengganti Undang-Undang',
                'singkatan' => 'PERPU',
                'kategori_dok' => 'P',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Peraturan Pemerintah',
                'singkatan' => 'PP',
                'kategori_dok' => 'P',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Peraturan Presiden',
                'singkatan' => 'PERPRES',
                'kategori_dok' => 'P',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Keputusan Presiden',
                'singkatan' => 'KEPRES',
                'kategori_dok' => 'P',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Instruksi Presiden',
                'singkatan' => 'INPRES',
                'kategori_dok' => 'P',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Peraturan Menteri',
                'singkatan' => 'PERMEN',
                'kategori_dok' => 'M',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Peraturan Kepala',
                'singkatan' => 'PERKA',
                'kategori_dok' => 'M',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Keputusan Menteri',
                'singkatan' => 'KEPMEN',
                'kategori_dok' => 'M',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Keputusan Kepala',
                'singkatan' => 'KEPKA',
                'kategori_dok' => 'M',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Instruksi Menteri',
                'singkatan' => 'INMEN',
                'kategori_dok' => 'M',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Peraturan Daerah Provinsi',
                'singkatan' => 'PERDA Provinsi',
                'kategori_dok' => 'D',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Peraturan Gubernur',
                'singkatan' => 'PERGUB',
                'kategori_dok' => 'D',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Keputusan Gubernur',
                'singkatan' => 'KEPGUB',
                'kategori_dok' => 'D',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Peraturan Daerah',
                'singkatan' => 'PERDA',
                'kategori_dok' => 'D',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Peraturan Walikota',
                'singkatan' => 'PERWAKO',
                'kategori_dok' => 'D',
                'id_jns_dok' => 1,
                'crid' => 1,
            ],[
                'nama' => 'Mahkamah Konstitusi',
                'singkatan' => 'MK',
                'kategori_dok' => 'P',
                'id_jns_dok' => 4,
                'crid' => 1,
            ],[
                'nama' => 'Mahkamah Agung',
                'singkatan' => 'MA',
                'kategori_dok' => 'P',
                'id_jns_dok' => 4,
                'crid' => 1,
            ],[
                'nama' => 'Pengadilan Tinggi',
                'singkatan' => 'PT',
                'kategori_dok' => 'P',
                'id_jns_dok' => 4,
                'crid' => 1,
            ],[
                'nama' => 'Pengadilan Negeri',
                'singkatan' => 'PN',
                'kategori_dok' => 'P',
                'id_jns_dok' => 4,
                'crid' => 1,
            ],[
                'nama' => 'Pengadilan Agama',
                'singkatan' => 'PA',
                'kategori_dok' => 'P',
                'id_jns_dok' => 4,
                'crid' => 1,
            ],[
                'nama' => 'Pengadilan Militer',
                'singkatan' => 'PM',
                'kategori_dok' => 'P',
                'id_jns_dok' => 4,
                'crid' => 1,
            ],[
                'nama' => 'Pengadilan Tata Usaha Negara',
                'singkatan' => 'PTUN',
                'kategori_dok' => 'P',
                'id_jns_dok' => 4,
                'crid' => 1,
            ],[
                'nama' => 'Pengadilan Pajak',
                'singkatan' => 'PP',
                'kategori_dok' => 'P',
                'id_jns_dok' => 4,
                'crid' => 1,
            ]
        ]);

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

        DB::table('ref_urusan_pemerintahan')->insert([
            [
                'nama' => 'Provinsi Kepulauan Riau',
                'kode' => '0021',
                'crid' => 1
            ],[
                'nama' => 'Kota Tanjungpinang',
                'kode' => '2107',
                'crid' => 1
            ]
        ]);

        DB::table('ref_bidang_hukum')->insert([
            [
                'nama' => 'HUKUM UMUM',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM ADAT',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM ADMINISTRASI NEGARA',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM AGRARIA',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM DAGANG',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM ISLAM',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM INTERNASIONAL',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM LINGKUNGAN',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM PERBURUHAN',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM PERDATA',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM PIDANA',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HUKUM TATA NEGARA',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'HIMPUNAN PERATURAN',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'PUTUSAN PENGADILAN',
                'singkatan' => '',
                'crid' => 1
            ],[
                'nama' => 'REFERENSI',
                'singkatan' => '',
                'crid' => 1
            ]
        ]);
    }
}
