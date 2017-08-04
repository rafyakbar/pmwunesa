<?php

namespace PMW;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PMW\Models\Laporan;
use PMW\Support\RequestStatus;

class User extends Authenticatable
{

    use Notifiable;

    const KETUA_TIM = 'Ketua Tim';

    const ANGGOTA = 'Anggota';

    const REVIEWER = 'Reviewer';

    const ADMIN_FAKULTAS = 'Admin Fakultas';

    const ADMIN_UNIVERSITAS = 'Admin Universitas';

    const DOSEN_PEMBIMBING = 'Dosen Pembimbing';

    const SUPER_ADMIN = 'Super Admin';

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

    public function jurusan()
    {
        return $this->belongsTo('PMW\Models\Prodi');
    }

    public function hakAksesPengguna()
    {
        return $this->belongsToMany('PMW\Models\HakAkses', 'hak_akses_pengguna', 'id_pengguna', 'id_hak_akses')->withPivot('status_request');
    }

    public function review()
    {
        return $this->belongsToMany('PMW\Models\Proposal', 'review', 'id_pengguna', 'id_proposal')->withPivot('id_review', 'tahap', 'komentar');
    }

    public function mahasiswa()
    {
        return $this->hasOne('PMW\Models\Mahasiswa', 'id_pengguna')->first();
    }

    public function proposal()
    {
        return $this->mahasiswa()->proposal();
    }

    public function laporan($jenis = null)
    {
        if (is_null($jenis)) {
            return $this->proposal()->laporan();
        } else {
            if ($jenis == Laporan::KEMAJUAN) {
                return $this->proposal()->laporan()->where('jenis', Laporan::KEMAJUAN)->first();
            } elseif ($jenis == Laporan::AKHIR) {
                return $this->proposal()->laporan()->where('jenis', Laporan::AKHIR)->first();
            }
        }
    }

    public function bimbingan()
    {
        return $this->belongsToMany('PMW\Models\Tim', 'bimbingan', 'id_pengguna', 'id_tim')->withPivot('status_request');
    }

    public function hasAnyRole(array $roles)
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role))
                return true;
        }
        return false;
    }

    public function hasRole($role)
    {
        return $this->hakAksesPengguna()
                ->where('nama', $role)
                ->where('status_request', RequestStatus::APPROVED)->count() > 0;
    }

    public function isKetua()
    {
        return ($this->hasRole(static::KETUA_TIM));
    }

    public function isAnggota()
    {
        return ($this->hasRole(static::ANGGOTA));
    }

    public function isMahasiswa()
    {
        return ($this->isKetua() || $this->isAnggota());
    }

    public function isSuperAdmin()
    {
        return ($this->hasRole(static::SUPER_ADMIN));
    }

    public function punyaTim()
    {
        return !is_null($this->mahasiswa()->id_proposal);
    }

    public function ketua()
    {
        $proposal = $this->mahasiswa()->id_proposal;

        return Proposal::find($proposal)->ketua();
    }

}
