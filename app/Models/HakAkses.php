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

    public function pengguna(){
        return $this->belongsToMany('PMW\User','hak_akses_pengguna','id_hak_akses','id_pengguna');
    }
}
