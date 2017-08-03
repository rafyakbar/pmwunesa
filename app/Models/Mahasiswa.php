<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public $table = 'mahasiswa';

    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'id_proposal',
        'ipk'
    ];

    public function pengguna()
    {
        return $this->belongsTo('PMW\User');
    }

    public function undanganTimKetua()
    {
        return $this->belongsToMany('PMW\Models\Mahasiswa', 'undangan_tim', 'id_ketua', 'id_anggota');
    }

    public function undanganTimAnggota()
    {
        return $this->belongsToMany('PMW\Models\Mahasiswa', 'undangan_tim', 'id_anggota', 'id_ketua');
    }

    public function proposal()
    {
        return $this->belongsTo('PMW\Models\Proposal');
    }
}