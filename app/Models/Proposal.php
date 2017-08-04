<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PMW\User;

class Proposal extends Model
{

    protected $table = 'proposal';

    protected $fillable = [
        'id',
        'lolos',
        'judul',
        'direktori',
        'direktori_final',
        'usulan_dana',
        'abstrak',
        'keyword',
        'jenis_usaha',
        'created_at',
        'updated_at'
    ];

    public function bimbingan()
    {
        return $this->belongsToMany('PMW\User', 'bimbingan', 'id_proposal', 'id_pengguna')->withPivot('status_request');
    }

    public function review()
    {
        return $this->belongsToMany('PMW\User', 'review', 'id_proposal', 'id_pengguna')->withPivot('id', 'tahap', 'komentar');
    }

    public function logbook()
    {
        return $this->hasMany('PMW\Models\LogBook', 'id_proposal');
    }

    public function laporan()
    {
        return $this->hasMany('PMW\Models\Laporan', 'id_proposal');
    }

    public function mahasiswa()
    {
        return $this->hasMany('PMW\Models\Mahasiswa');
    }

    public function ketua()
    {
        $tim = DB::table('mahasiswa')
            ->whereRaw('id_proposal = ' . $this->id)
            ->select('id_pengguna')
            ->toSql();

        $ketua = DB::table('hak_akses')
            ->whereRaw('nama = \'Ketua Tim\'')
            ->select('id')
            ->toSql();

        $tabel = '(' . $tim . ') as tim, (' . $ketua . ') as ketua, hak_akses_pengguna';

        $idketua = DB::table(DB::raw($tabel))
            ->whereRaw('tim.id_pengguna = hak_akses_pengguna.id_pengguna AND hak_akses_pengguna.id_hak_akses = ketua.id')
            ->select(DB::raw('tim.id_pengguna'))->first();
        return User::find($idketua->id_pengguna);
    }
}
