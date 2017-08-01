<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function pengguna(){
        return $this->belongsToMany('PMW\User','tim','id_proposal','id_pengguna')->withPivot('ipk');
    }

    public function review(){
        return $this->hasMany('PMW\Models\Review');
    }

    public function logbook(){
        return $this->hasMany('PMW\Models\LogBook');
    }

    public function laporan(){
        return $this->hasMany('PMW\Models\Laporan');
    }
}
