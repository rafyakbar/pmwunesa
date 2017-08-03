<?php

use Illuminate\Database\Seeder;
use PMW\User;
use PMW\Models\HakAkses;
use PMW\Models\Proposal;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(HakAkses::where('nama',User::KETUA_TIM)->pengguna()->cursor() as $ketua)
        {
            factory(Proposal::class, 50)->create()->each(function ($u) {
                $u->make();
            });
        }
    }

}
