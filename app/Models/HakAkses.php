<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{

    const KETUA_TIM = 'Ketua Tim';

    const ANGGOTA = 'Anggota';

    const REVIEWER = 'Reviewer';

    const ADMIN_FAKULTAS = 'Admin Fakultas';

    const ADMIN_UNIVERSITAS = 'Admin Universitas';

    const DOSEN_PEMBIMBING = 'Dosen Pembimbing';

    const SUPER_ADMIN = 'Super Admin';

    protected $table = 'hak_akses';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama'
    ];

    /**
     * Mendapatkan daftar pengguna dari hak akses tertentu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pengguna()
    {
        return $this->belongsToMany('PMW\User','hak_akses_pengguna','id_hak_akses','id_pengguna');
    }
}
