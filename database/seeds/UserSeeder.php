<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PMW\User::class, 50)->create()->each(function ($u) {
            $u->make();
        });
    }
}