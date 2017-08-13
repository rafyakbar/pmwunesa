<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PMW\User;
use PMW\Models\Laporan;
use PMW\Support\RequestStatus;

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

    /**
     * Mendapatkan pembmbing dari proposal terkait
     * @return BelongsToMany
     */
    public function bimbingan()
    {
        return $this->belongsToMany('PMW\User', 'bimbingan', 'id_tim', 'id_pengguna')->withPivot('status_request');
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

    public function laporanAkhir()
    {
        return $this->laporan()->where('jenis', Laporan::AKHIR)->first();
    }

    public function laporanKemajuan()
    {
        return $this->laporan()->where('jenis', Laporan::KEMAJUAN)->first();
    }

    public function mahasiswa()
    {
        return $this->hasMany('PMW\Models\Mahasiswa', 'id_proposal');
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

    public function lolos()
    {
        return ($this->lolos);
    }

    public function sudahDinilaiOleh($reviewer,$tahap = null)
    {
        $query = DB::table(DB::raw('pengguna, penilaian, review'))
            ->whereRaw('pengguna.id = \''.$reviewer.'\'')
            ->whereRaw('review.id_pengguna = pengguna.id')
            ->whereRaw('penilaian.id_review = review.id')
            ->whereRaw('review.id_proposal = ' . $this->id);

        if(!is_null($tahap))
            $query = $query->whereRaw('review.tahap = ' . $tahap);

        return ($query->count('penilaian.nilai') > 0);
    }

    public function penilaian()
    {
        $review = Review::find($this->pivot->id)->penilaian();

        return $review;
    }

    public function tambahPembimbing($dosen)
    {
        $this->bimbingan()->detach($dosen);

        $this->bimbingan()->attach($dosen, [
            'status_request' => RequestStatus::APPROVED
        ]);
    }
}
