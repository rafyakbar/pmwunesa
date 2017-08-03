<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(PMW\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'id' => $faker->isbn10,
        'nama' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'request' => true
    ];
});

$factory->define(PMW\Models\Proposal::class, function(Faker\Generator $faker){
    return [
        'judul' => $faker->sentence,
        'direktori' => 'dir',
        'usulan_dana' => $faker->numberBetween(2000000,5000000),
        'abstrak' => $faker->text(300),
        'keyword' => 'keyword',
        'jenis_usaha' => 'barang'
    ];
});

$factory->define(PMW\Models\HakAksesPengguna::class,function(Faker\Generator $faker){
    return [
        'id_pengguna' => function(){
            return (PMW\User::all()->pluck('id'))[rand(0,count(PMW\User::all())-1)]; 
        },
        'id_hak_akses' => function(){
            return [1,1,1,1,3,4,5,6,7][rand(0,8)];
            // return (PMW\Models\HakAkses::all()->pluck('id'))[rand(0,count(PMW\Models\HakAkses::all())-1)]; 
        },
        'status_request' => 'entah'
    ];
});

$factory->define(PMW\Models\Tim::class, function(Faker\Generator $faker){
    return [
        'id_pengguna' => function(){
            return (PMW\User::all()->pluck('id'))[rand(0,count(PMW\User::all()))]; 
        },
        'id_proposal' => function(){
            return (PMW\Models\Proposal::all()->pluck('id'))[rand(0,count(PMW\Models\Proposal::all()))]; 
        }
    ];
});