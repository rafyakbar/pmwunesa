<?php

use Illuminate\Database\Seeder;
use PMW\User;
use PMW\Models\HakAkses;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user)
        {
            $user->hakAksesPengguna()->attach(HakAkses::find([1,1,1,1,3,4,5,6,7][rand(0,8)]),[
                'status_request' => \PMW\Support\RequestStatus::APPROVED
            ]);
        }
//        factory(PMW\User::class, 50)->create()->each(function ($u) {
//            $u->make();
//        });
    }
}
