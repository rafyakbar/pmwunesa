<?php

use Illuminate\Database\Seeder;

class AspekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for (int $c = 1; $c <= 10; $c++)
            DB::table('aspek')->insert([
                'nama' => 'aspek ' . $c,
            ]);
    }
}
