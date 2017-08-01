<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_jurusan',
        'nama'
    ];

    public function jurusan(){
        return $this->belongsTo('PMW\Models\Jurusan');
    }

    public function pengguna(){
        return $this->hasMany('PMW\User');
    }
}
