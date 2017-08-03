<?php

use Illuminate\Database\Seeder;
use PMW\Models\Proposal;
use PMW\Models\HakAkses;
use PMW\User;

class ProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Proposal::class, HakAkses::where('nama',User::KETUA_TIM)->count())->create()->each(function ($seed) {
            $seed->make();
        });
    }

}
