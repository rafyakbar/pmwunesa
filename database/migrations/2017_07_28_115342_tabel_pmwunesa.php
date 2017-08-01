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
                ->references('id')
                ->on('fakultas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('nama', 50);
        });

        Schema::create('prodi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jurusan')->unsigned();
            $table->foreign('id_jurusan')
                ->references('id')
                ->on('jurusan')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('nama', 50);
        });

        Schema::create('pengguna', function (Blueprint $table) {
            $table->string('id', 25)->unique()->primary();
            $table->integer('id_prodi')->nullable()->unsigned();
            $table->foreign('id_prodi')
                ->references('id')
                ->on('prodi')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('nama')->nullable();
            $table->string('email', 50);
            $table->string('alamat_asal')->nullable();
            $table->string('alamat_tinggal')->nullable();
            $table->string('no_telepon', 15)->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('hak_akses', function (Blueprint $table){
            $table->increments('id');
            $table->string('nama', 50);
        });

        Schema::create('hak_akses_pengguna', function (Blueprint $table){
            $table->integer('id_hak_akses')->unsigned();
            $table->foreign('id_hak_akses')
                ->references('id')
                ->on('hak_akses')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('id_pengguna', 25);
            $table->foreign('id_pengguna')
                ->references('id')->on('pengguna')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
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
            $table->bigIncrements('id');
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
        });

        Schema::create('aspek', function (Blueprint $table){
            $table->increments('id');
            $table->text('keterangan');
        });

        Schema::create('penilaian', function (Blueprint $table){
            $table->integer('id_aspek')->unsigned();
            $table->foreign('id_aspek')
                ->references('id')
                ->on('aspek')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->bigInteger('id_review')->unsigned();
            $table->foreign('id_review')
                ->references('id')
                ->on('review')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });

        Schema::create('logbook', function (Blueprint $table){
            $table->bigInteger('id_proposal')->unsigned();
            $table->foreign('id_proposal')
                ->references('id')
                ->on('proposal')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->text('catatan');
            $table->bigInteger('biaya')->nullable();
            $table->timestamps();
        });

        Schema::create('laporan', function (Blueprint $table){
            $table->bigInteger('id_proposal')->unsigned();
            $table->foreign('id_proposal')
                ->references('id')
                ->on('proposal')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('jenis',25);
            $table->text('direktori');
            $table->text('keterangan');
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
