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

    public function bimbingan(){
        return $this->belongsToMany('PMW\User','bimbingan','id_proposal','id_pengguna')->withPivot('status_request');
    }

    public function review(){
        return $this->belongsToMany('PMW\User','review','id_proposal','id_pengguna')->withPivot('id','tahap','komentar');
    }

    public function logbook(){
        return $this->hasMany('PMW\Models\LogBook');
    }

    public function laporan(){
        return $this->hasMany('PMW\Models\Laporan');
    }

    public function mahasiswa(){
        return $this->hasMany('PMW\Models\Mahasiswa');
    }
}
