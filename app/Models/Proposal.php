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
     *
     * @return BelongsToMany
     */
    public function bimbingan()
    {
        return $this->belongsToMany('PMW\User', 'bimbingan', 'id_tim', 'id_pengguna')->withPivot('status_request');
    }

    public function pembimbing()
    {
        return $this->bimbingan()->first();
    }

    public function reviewer()
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

    public function punyaProposalFinal()
    {
        return (!is_null($this->direktori_final));
    }

    public function punyaPembimbing()
    {
        return (!is_null($this->pembimbing()));
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

    public function sudahDinilaiOleh($reviewer, $tahap = null)
    {
        $query = DB::table(DB::raw('pengguna, penilaian, review'))
            ->whereRaw('pengguna.id = \'' . $reviewer . '\'')
            ->whereRaw('review.id_pengguna = pengguna.id')
            ->whereRaw('penilaian.id_review = review.id')
            ->whereRaw('review.id_proposal = ' . $this->id);

        if (!is_null($tahap))
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

    public static function proposalPerFakultas($idfakultas)
    {
        return DB::table(DB::raw("proposal, (
            SELECT
              hak_akses_pengguna.id_pengguna AS id_ketua,
              pengguna.nama AS nama_ketua,
              id_fakultas
            FROM
              (
                SELECT hak_akses.id
                FROM hak_akses
                WHERE hak_akses.nama = 'Ketua Tim'
              ) AS hakakses,
              hak_akses_pengguna
              LEFT JOIN (pengguna
              LEFT JOIN (prodi
                LEFT JOIN jurusan ON prodi.id_jurusan = jurusan.id) ON pengguna.id_prodi = prodi.id)
                ON pengguna.id = hak_akses_pengguna.id_pengguna
            WHERE hak_akses_pengguna.id_hak_akses = hakakses.id AND jurusan.id_fakultas = ".$idfakultas."
          ) AS ketua, mahasiswa"))->select(DB::raw('*'))->whereRaw('mahasiswa.id_pengguna = ketua.id_ketua AND proposal.id=mahasiswa.id_proposal')->get();
    }
}
