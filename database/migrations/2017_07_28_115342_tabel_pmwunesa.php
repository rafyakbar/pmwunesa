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
        Schema::create('fakultas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50);
        });

        Schema::create('jurusan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_fakultas')->unsigned();
            $table->foreign('id_fakultas')
                ->references('id')->on('fakultas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('nama', 50);
        });

        Schema::create('prodi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jurusan')->unsigned();
            $table->foreign('id_jurusan')
                ->references('id')->on('jurusan')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('nama', 50);
        });

        Schema::create('pengguna', function (Blueprint $table) {
            $table->string('id', 25)->unique()->primary();
            $table->integer('id_prodi')->nullable()->unsigned();
            $table->foreign('id_prodi')
                ->references('id')->on('prodi')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('nama')->nullable();
            $table->string('email', 50);
            $table->string('alamat_asal')->nullable();
            $table->string('alamat_tinggal')->nullable();
            $table->string('no_telepon', 15)->nullable();
            $table->string('hak_akses', 25);
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('proposal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('lolos')->nullable();
            $table->string('judul');
            $table->string('direktori');
            $table->bigInteger('usula_dana');
            $table->text('abstrak');
            $table->text('keyword');
            $table->string('jenis_usaha');
            $table->timestamps();
        });

        Schema::create('tim', function (Blueprint $table) {
            $table->string('id_pengguna', 25);
            $table->foreign('id_pengguna')
                ->references('id')->on('pengguna')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->bigInteger('id_proposal')->unsigned();
            $table->foreign('id_proposal')
                ->references('id')->on('proposal')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->float('ipk', 4, 2)->nullable();
        });

        Schema::create('review', function (Blueprint $table) {
            $table->string('id_pengguna', 25);
            $table->foreign('id_pengguna')
                ->references('id')->on('pengguna')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->bigInteger('id_proposal')->unsigned();
            $table->foreign('id_proposal')
                ->references('id')->on('proposal')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->integer('tahap');
            $table->string('komentar');
            $table->timestamps();
            $table->tinyInteger('n_1')->unsigned()->nullable();
            $table->tinyInteger('n_2')->unsigned()->nullable();
            $table->tinyInteger('n_3')->unsigned()->nullable();
            $table->tinyInteger('n_4')->unsigned()->nullable();
            $table->tinyInteger('n_5')->unsigned()->nullable();
            $table->tinyInteger('n_6')->unsigned()->nullable();
            $table->tinyInteger('n_7')->unsigned()->nullable();
            $table->tinyInteger('n_8')->unsigned()->nullable();
            $table->tinyInteger('n_9')->unsigned()->nullable();
            $table->tinyInteger('n_10')->unsigned()->nullable();
            $table->tinyInteger('n_11')->unsigned()->nullable();
        });

        Schema::create('logbook', function (Blueprint $table){
            $table->bigInteger('id_proposal')->unsigned();
            $table->foreign('id_proposal')
                ->references('id')->on('proposal')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('deskripsi');
            $table->bigInteger('biaya')->nullable();
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
