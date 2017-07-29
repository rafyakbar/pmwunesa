<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    protected $table = 'tim';

    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'id_proposal',
        'ipk'
    ];
}
