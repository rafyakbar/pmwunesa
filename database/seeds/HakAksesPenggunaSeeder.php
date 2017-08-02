<?php

use Illuminate\Database\Seeder;

class HakAksesPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PMW\Models\HakAksesPengguna::class, 20)->create()->each(function ($u) {
            $u->make();
        });
    }
}
