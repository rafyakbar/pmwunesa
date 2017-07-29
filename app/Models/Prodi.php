<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';

    protected $fillable = [
        'id_jurusan',
        'nama'
    ];
}
