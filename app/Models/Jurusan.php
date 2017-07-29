<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $fillable = [
        'id_fakultas',
        'nama'
    ];
}
