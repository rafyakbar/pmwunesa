<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_fakultas',
        'nama'
    ];

    public function prodi(){
        return $this->hasMany('PMW\Models\Prodi');
    }

    public function fakultas(){
        return $this->belongsTo('PMW\Models\Fakultas');
    }
}
