<?php

use Illuminate\Database\Seeder;
use PMW\User;
use PMW\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(User::whereNotIn('id', [
            '15051204010',
            '15051204037',
            '15051204025',
            '15051204014',
            '15051204030',
            '15051204043'
        ])->cursor() as $mhs)
        {
            if($mhs->isMahasiswa())
            {
                Mahasiswa::create([
                    'id_pengguna' => $mhs->id,
                    'ipk' => rand(0,4)
                ]);
            }
        }
    }
}
