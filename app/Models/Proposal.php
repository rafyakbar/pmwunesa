<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    /**
     * Mendapatkan pembimbing dari proposal terkait
     *
     * @return mixed
     */
    public function pembimbing()
    {
        return $this->bimbingan()->first();
    }

    /**
     * Mendapatkan daftar reviewer dari proposal terkait
     *
     * @return BelongsToMany
     */
    public function reviewer()
    {
        return $this->belongsToMany('PMW\User', 'review', 'id_proposal', 'id_pengguna')->withPivot('id', 'tahap', 'komentar');
    }

    /**
     * Mendapatkan daftar logbook dari proposal terkait
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logbook()
    {
        return $this->hasMany('PMW\Models\LogBook', 'id_proposal');
    }

    /**
     * Mendapatkan laporan dari proposal terkait
     *
     * @param null $type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|mixed|null
     */
    public function laporan($type = null)
    {
        $relasi = $this->hasMany('PMW\Models\Laporan', 'id_proposal');
        if (is_null($type))
            return $relasi;
        else if ($type == 'kemajuan')
            return $relasi->where('jenis', 'kemajuan')->first();
        else if ($type == 'akhir')
            return $relasi->where('jenis', 'akhir')->first();

        return null;
    }

    /**
     * Mengecek apakah proposal memiliki proposal final
     *
     * @return bool
     */
    public function punyaProposalFinal()
    {
        return (!is_null($this->direktori_final));
    }

    /**
     * Mengeek apakah proposal/tim telah memiliki pembimbing
     *
     * @return bool
     */
    public function punyaPembimbing()
    {
        return (!is_null($this->pembimbing()));
    }

    /**
     * Mendapatakan laporan akhir dari tim terkait
     *
     * @return mixed
     */
    public function laporanAkhir()
    {
        return $this->laporan()->where('jenis', Laporan::AKHIR)->first();
    }

    /**
     * Mendapatakan laporan kemajuan
     *
     * @return mixed
     */
    public function laporanKemajuan()
    {
        return $this->laporan()->where('jenis', Laporan::KEMAJUAN)->first();
    }

    /**
     * Mendapatkan daftar mahasiswa yang merupakan anggota tim dari proposal
     * terkait
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mahasiswa()
    {
        return $this->hasMany('PMW\Models\Mahasiswa', 'id_proposal');
    }

    /**
     * Mendapatkan ketua dari proposal tertentu
     *
     * @return \Illuminate\Database\Eloquent\Collection|Model|null|static|static[]
     */
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

    /**
     * Mengecek apakah proposal lolos pada tahap tertentu
     *
     * @param int $tahap
     * @return bool
     */
    public function lolos($tahap = 2)
    {
        if (!is_null($tahap)) {
            if ($this->nilai($tahap) === 25)
                return true;
        }

        if ($this->lolos)
            return true;

        return false;
    }

    /**
     * Mendapatkan total nilai dari proposal tertentu
     *
     * @param $tahap
     * @return int|null
     */
    public function nilai($tahap)
    {
        if(!is_null($this->daftarReview($tahap))){
            $sum = 0;
            foreach ($this->daftarReview($tahap)->get() as $nilai){
                $sum += $nilai->penilaian()->sum('nilai');
            }

            return $sum;
        }

        return null;
    }

    /**
     * Mengecek apakah proposal telah dinilai oleh user tertentu dan dalam
     * tahap tertentu
     *
     * @param $reviewer
     * @param null $tahap
     * @return bool
     */
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

    /**
     * Mengecek apakah proposal sedang dalam proses penilaian pada tahap
     * tertentu
     *
     * @param int $tahap
     * @return bool
     */
    public function dalamProsesPenilaian($tahap = 2)
    {
        if (!is_null($this->daftarReview($tahap))) {
            foreach ($this->daftarReview($tahap) as $penilaian){
                if($penilaian->penilaian()->count() > 0)
                    return true;
            }
        }

        return false;
    }

    /**
     * Mendapatkan instance Review dari proposal tertentu
     *
     * @param $tahap
     * @return Review|null
     */
    public function daftarReview($tahap)
    {
        $review = Review::where('id_proposal', $this->id)
            ->where('tahap', $tahap);

        if ($review->count() > 0)
            return $review;

        return null;
    }

    public function penilaian($idreview)
    {
        $review = Review::find($idreview);

        return $this->daftarReview($review->tahap)->first()->penilaian();
    }

    /**
     * Mengecek apakah proposal memiliki nilai
     *
     * @return bool
     */
    public function punyaNilai()
    {
        if ($this->dalamProsesPenilaian(1) ||
            $this->dalamProsesPenilaian(2) ||
            $this->lolos())
            return true;

        return false;
    }

    /**
     * Menambah pembimbing dari proposal
     *
     * @param User $dosen
     */
    public function tambahPembimbing($dosen)
    {
        $this->bimbingan()->updateExistingPivot($dosen->id, [
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
          ) AS ketua, mahasiswa"))->select(DB::raw('DISTINCT id_proposal AS id, judul, lolos, direktori, direktori_final, usulan_dana, abstrak, keyword, jenis_usaha, created_at, updated_at'))->whereRaw('mahasiswa.id_pengguna = ketua.id_ketua AND proposal.id=mahasiswa.id_proposal')->get();
    }
}
