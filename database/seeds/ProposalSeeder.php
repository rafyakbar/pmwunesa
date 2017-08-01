<?php

use Illuminate\Database\Seeder;

class ProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PMW\Models\Proposal::class, 18)->create()->each(function ($seed) {
            $seed->make();
        });
    }
}
