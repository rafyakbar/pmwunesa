<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelPMWUNESA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fakultas',function (Blueprint $table){
            $table->increments('id');
            $table->string('nama',50);
        });

        Schema::create('jurusan',function (Blueprint $table){
            $table->increments('id');
            $table->integer('id_fakultas')->unsigned();
            $table->foreign('id_fakultas')->references('id')->on('fakultas');
            $table->string('nama',50);
        });

        Schema::create('prodi',function (Blueprint $table){
            $table->increments('id');
            $table->integer('id_jurusan')->unsigned();
            $table->foreign('id_jurusan')->references('id')->on('jurusan');
            $table->string('nama',50);
        });

        Schema::create('pengguna',function (Blueprint $table){
           $table->string('id_pengguna',25)->primary();
           $table->integer('id_prodi')->unsigned();
           $table->foreign('id_prodi')->references('id')->on('prodi');
           $table->string('nama',50)->nullable();
           $table->string('email',50);
           $table->string('alamat_asal',100)->nullable();
           $table->string('alamat_tinggal',100)->nullable();
           $table->string('no_telepon',15)->nullable();
           $table->string('hak_akses',15);
           $table->string('password',255)->nullable();
           $table->rememberToken();
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
