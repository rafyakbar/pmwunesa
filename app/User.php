<?php

namespace PMW;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PMW\Models\HakAkses;
use PMW\Support\RequestStatus;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{

    use Notifiable;

    protected $table = 'pengguna';

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_prodi',
        'nama',
        'email',
        'alamat_asal',
        'alamat_tinggal',
        'no_telepon',
        'hak_akses',
        'password',
        'request'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Merelasikan dengan prodi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function prodi()
    {
        return $this->hasOne('PMW\Models\Prodi');
    }

    /**
     * Mendapatkan hak akses dari user tertentu
     *
     * @param null $hakAkses
     * @return $this|mixed
     */
    public function hakAksesPengguna($hakAkses = null)
    {
        if (!is_null($hakAkses)) {
            return $this->belongsToMany(
                'PMW\Models\HakAkses',
                'hak_akses_pengguna',
                'id_pengguna',
                'id_hak_akses')
                ->withPivot('status_request')
                ->where('id_hak_akses', $hakAkses->id)->first();
        }
        return $this->belongsToMany(
            'PMW\Models\HakAkses',
            'hak_akses_pengguna',
            'id_pengguna',
            'id_hak_akses')
            ->withPivot('status_request');
    }

    /**
     * Mengecek apakah permintaan hak akses user ditolak
     *
     * @param HakAkses $hakAkses
     * @return bool
     */
    public function hakAksesDitolak($hakAkses)
    {
        return ($this->hakAksesPengguna()
                ->where('id_hak_akses', $hakAkses->id)
                ->where('status_request', RequestStatus::REJECTED)
                ->count() > 0);
    }

    /**
     * Merelasikan dengan review
     *
     * @return BelongsToMany
     */
    public function review()
    {
        return $this->belongsToMany('PMW\Models\Proposal', 'review', 'id_pengguna', 'id_proposal')->withPivot('tahap', 'komentar', 'id');
    }

    /**
     * Merelasikan dengan tabel mahasiswa
     *
     * @return mixed
     */
    public function mahasiswa()
    {
        return $this->hasOne('PMW\Models\Mahasiswa', 'id_pengguna')->first();
    }

    /**
     * Merelasikan dengan tabel bimbingan jika user adalah dosen pembimbing
     *
     * @return BelongsToMany
     */
    public function bimbingan()
    {
        return $this->belongsToMany(
            'PMW\Models\Proposal',
            'bimbingan',
            'id_pengguna',
            'id_tim')
            ->withPivot('status_request');
    }

    /**
     * Mengecek apakah user terkait memiliki salah satu diantara beberapa role yang diinginkan
     *
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole(array $roles)
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role))
                return true;
        }
        return false;
    }

    /**
     * Mengecek apakah user memiliki role tertentu
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->hakAksesPengguna()
                ->where('nama', $role)
                ->where('status_request', RequestStatus::APPROVED)->count() > 0;
    }

    /**
     * Mengecek apakah user adalah seorang ketua tim
     *
     * @return bool
     */
    public function isKetua()
    {
        return ($this->hasRole(HakAkses::KETUA_TIM));
    }

    /**
     * Mengecek apakah user adalah seorang anggota
     *
     * @return bool
     */
    public function isAnggota()
    {
        return ($this->hasRole(HakAkses::ANGGOTA));
    }

    /**
     * Mengecek apakah user merupakan mahasiswa, dengan kata lain
     * apakah user adalah ketua atau anggota
     *
     * @return bool
     */
    public function isMahasiswa()
    {
        return ($this->isKetua() || $this->isAnggota());
    }

    /**
     * Mengecek apakah user adalah super admin
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return ($this->hasRole(HakAkses::SUPER_ADMIN));
    }

    /**
     * Mengecek apakah user adalah dosen pembimbing
     *
     * @return bool
     */
    public function isDosenPembimbing()
    {
        return $this->hasRole(HakAkses::DOSEN_PEMBIMBING);
    }

    /**
     * Mengecek apakah user adalah seorang reviewer
     *
     * @return bool
     */
    public function isReviewer()
    {
        return $this->hasRole(HakAkses::REVIEWER);
    }

    /**
     * Mengecek apakah user sedang meminta suatu hak akses tertentu
     *
     * @param $hakAkses
     * @return bool
     */
    public function requestingHakAkses($hakAkses)
    {
        return $this->hakAksesPengguna()
                ->where('nama', $hakAkses)
                ->where('status_request',RequestStatus::REQUESTING)
                ->count() == 1;
    }

    /**
     * Melakukan pencarian terhadap suatu user berdasarkan kolom tertentu
     * pada tabel pengguna, kata kunci, serta hak akses dari pengguna
     * yang akan dicari
     *
     * @param string $column
     * @param string|int $value
     * @param string $roles
     * @param string $logic
     * @return mixed
     */
    public static function cari($column, $value, $roles, $logic = 'OR')
    {
        $qualifier = '';
        if (is_string($roles))
            $qualifier .= 'hak_akses.nama = \'' . $roles . '\'';
        elseif (is_array($roles)) {
            foreach ($roles as $index => $role) {
                $qualifier .= 'hak_akses.nama = \'' . $role . '\'';
                if ($index < count($roles) - 1)
                    $qualifier .= ($logic == 'OR') ? ' OR ' : 'AND ';
            }
        }

        $filteredUser = DB::table(DB::raw('(SELECT hak_akses.id FROM hak_akses WHERE ' . $qualifier . ') AS role, hak_akses_pengguna'))
        ->select(DB::raw('hak_akses_pengguna.id_pengguna'))
        ->whereRaw('hak_akses_pengguna.id_hak_akses = role.id')
        ->toSql();

        $query = DB::table(DB::raw('('.$filteredUser.') as filteredUser,
  pengguna LEFT JOIN (prodi RIGHT JOIN (jurusan RIGHT JOIN fakultas ON jurusan.id_fakultas = fakultas.id) ON prodi.id_jurusan = jurusan.id) ON pengguna.id_prodi = prodi.id'))
            ->select(DB::raw('pengguna.*,prodi.nama AS nama_prodi, jurusan.nama AS nama_jurusan, fakultas.nama AS nama_fakultas'))
            ->whereRaw('lower(pengguna.' . $column . ') LIKE lower(\'%' . $value . '%\') AND pengguna.id = filteredUser.id_pengguna')
            ->distinct();

        return $query->get();
    }

    /**
     * Menjadikan seorang user menjadi ketua tim
     *
     * @return void
     */
    public function jadikanKetua()
    {
        if($this->isAnggota()) {
            // Menghapus hak akses sebagai anggota dari pengirim undangan
            $this->hakAksesPengguna()->detach(HakAkses::where('nama', HakAkses::ANGGOTA)->first());
            // menjadikan pengirim undangan sebagai ketua
            $this->hakAksesPengguna()->attach(HakAkses::where('nama', HakAkses::KETUA_TIM)->first(), ['status_request' => RequestStatus::APPROVED]);
        }
    }

}
