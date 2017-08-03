<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public $table = 'mahasiswa';

    public $primaryKey = 'id_pengguna';

    public $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'id_proposal',
        'ipk'
    ];

    public function pengguna()
    {
        return $this->belongsTo('PMW\User',$this->primaryKey)->first();
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
        return $this->belongsTo('PMW\Models\Proposal','id_proposal')->first();
    }

}
