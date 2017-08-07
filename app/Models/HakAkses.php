<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
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
