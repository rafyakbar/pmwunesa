<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class HakAksesPengguna extends Model
{
    public $table = 'hak_akses_pengguna';

    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'id_hak_akses'
    ];
}
