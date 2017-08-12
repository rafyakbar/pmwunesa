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

    public function jurusan()
    {
        return $this->belongsTo('PMW\Models\Prodi');
    }

    /**
     * Mendapatkan hak akses dari user tertentu
     *
     * @param null $hakAkses
     * @return $this|mixed
     */
    public function hakAksesPengguna($hakAkses = null)
    {
        if(!is_null($hakAkses)) {
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
            ->where('id_hak_akses',$hakAkses->id)
            ->where('status_request',RequestStatus::REJECTED)
            ->count() > 0);
    }

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
    public function bimbingan($status = null)
    {
        $bimbingan = $this->belongsToMany(
            'PMW\Models\Proposal',
            'bimbingan',
            'id_pengguna',
            'id_tim')
            ->withPivot('status_request');

        if(!is_null($status))
            $bimbingan = $bimbingan->where('status_request',$status);

        return $bimbingan;
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

    public function hasRole($role)
    {
        return $this->hakAksesPengguna()
                ->where('nama', $role)
                ->where('status_request', RequestStatus::APPROVED)->count() > 0;
    }

    public function isKetua()
    {
        return ($this->hasRole(HakAkses::KETUA_TIM));
    }

    public function isAnggota()
    {
        return ($this->hasRole(HakAkses::ANGGOTA));
    }

    public function isMahasiswa()
    {
        return ($this->isKetua() || $this->isAnggota());
    }

    public function isAdminFakultas()
    {
        return ($this->hasRole(HakAkses::ADMIN_FAKULTAS));
    }

    public function isAdminUniversitas()
    {
        return ($this->hasRole(HakAkses::ADMIN_UNIVERSITAS));
    }

    public function isSuperAdmin()
    {
        return ($this->hasRole(HakAkses::SUPER_ADMIN));
    }

    public function isDosenPembimbing()
    {
        return $this->hasRole(HakAkses::DOSEN_PEMBIMBING);
    }

    public function isReviewer()
    {
        return $this->hasRole(HakAkses::REVIEWER);
    }

    public function requestingHakAkses($hakAkses)
    {
        return $this->hakAksesPengguna()->where('nama', $hakAkses)->count() == 1;
    }

    public static function cari($column, $value, $roles, $logic = 'OR')
    {
        $qualifier = '';
        if(is_string($roles))
            $qualifier .= 'hak_akses.nama = \'' . $roles . '\'';
        elseif (is_array($roles))
        {
            foreach ($roles as $index => $role)
            {
                $qualifier .= 'hak_akses.nama = \'' . $role . '\'';
                if($index < count($roles)-1)
                    $qualifier .= ($logic == 'OR') ? ' OR ' : 'AND ';
            }
        }
        $query = DB::table(DB::raw('pengguna JOIN (SELECT * FROM hak_akses_pengguna, hak_akses WHERE '. $qualifier .') AS mhs ON mhs.id_pengguna = pengguna.id'))
            ->select(DB::raw('pengguna.*'))
            ->whereRaw('pengguna.'.$column.' LIKE \'%'.$value.'%\'')
            ->distinct();

        return $query->get();
    }

    public function jadikanKetua()
    {
        // Menghapus hak akses sebagai anggota dari pengirim undangan
        $this->hakAksesPengguna()->detach(HakAkses::where('nama', HakAkses::ANGGOTA)->first());
        // menjadikan pengirim undangan sebagai ketua
        $this->hakAksesPengguna()->attach(HakAkses::where('nama', HakAkses::KETUA_TIM)->first(), ['status_request' => 'Approved']);
    }

}
