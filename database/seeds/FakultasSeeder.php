<?php

use Illuminate\Database\Seeder;
use PMW\Models\Fakultas;

class FakultasSeeder extends Seeder
{

    private $fakultas = [
        'Ilmu Pendidikan',
        'Bahasa & Seni',
        'Matematika & Ilmu Pengetahuan Alam',
        'Ilmu Sosial & Hukum',
        'Teknik',
        'Ilmu Keolahragaan',
        'Ekonomi'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->fakultas as $item)
        {
            Fakultas::create([
                'nama' => 'Fakultas ' . $item
            ]);
        }
    }

}
