<?php

use Illuminate\Database\Seeder;
use PMW\Models\Aspek;

class AspekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //aspek pemasaran
        Aspek::create([
            'nama' => 'Perencanaan produk',
            'tahap' => 1
        ]);
        Aspek::create([
            'nama' => 'Penetapan harga',
            'tahap' => 1
        ]);
        Aspek::create([
            'nama' => 'System distribusi',
            'tahap' => 1
        ]);
        Aspek::create([
            'nama' => 'Kegiatan promosi',
            'tahap' => 2
        ]);
        Aspek::create([
            'nama' => 'Pasar',
            'tahap' => 2
        ]);
        Aspek::create([
            'nama' => 'Persaingan',
            'tahap' => 2
        ]);
        Aspek::create([
            'nama' => 'Relasi jaringan',
            'tahap' => 2
        ]);

        //aspek manajemen dan organisasi
        Aspek::create([
            'nama' => 'Merekap pengeluaran dan pemasukan usaha',
            'tahap' => 1
        ]);
        Aspek::create([
            'nama' => 'Memonitor mobilitas produksi',
            'tahap' => 1
        ]);
        Aspek::create([
            'nama' => 'Pelaporan',
            'tahap' => 2
        ]);

        //aspek produksi
        Aspek::create([
            'nama' => 'Proses produksi dan jasa',
            'tahap' => 1
        ]);
        Aspek::create([
            'nama' => 'Mesin dan peralatan yang dibutuhkan',
            'tahap' => 1
        ]);
        Aspek::create([
            'nama' => 'Bahan baku dan bahan embantu yang dibutuhkan',
            'tahap' => 2
        ]);
        Aspek::create([
            'nama' => 'Tenaga produksi',
            'tahap' => 2
        ]);
    }
}
