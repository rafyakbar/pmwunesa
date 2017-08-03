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
        foreach(User::all() as $mhs)
        {
            if($mhs->hasAnyRole([User::KETUA_TIM,User::ANGGOTA]))
            {
                Mahasiswa::create([
                    'id_pengguna' => $mhs->id,
                    'ipk' => rand(0,4)
                ]);
            }
        }
    }
}
