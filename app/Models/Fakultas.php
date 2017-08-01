<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama'
    ];

    public function jurusan(){
        return $this->hasMany('PMW\Models\Jurusan');
    }
}
