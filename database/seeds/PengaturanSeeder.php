<?php

use Illuminate\Database\Seeder;
use PMW\Models\Pengaturan;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengaturan::create([
            'nama'      => 'nilai minimum proposal',
            'keterangan'=> '18'
        ]);

        Pengaturan::create([
            'nama'      => 'Batas pengumpulan proposal',
            'keterangan'=> '2017-09-15 23:59:59'
        ]);

        Pengaturan::create([
            'nama'      => 'Batas penilaian proposal',
            'keterangan'=> '2017-10-15 23:59:59'
        ]);
    }
}
