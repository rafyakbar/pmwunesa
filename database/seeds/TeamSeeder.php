<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PMW\Models\Tim::class, 6)->create()->each(function ($seed) {
            $seed->make();
        });
    }

}
