<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    public $table = 'pengaturan';

    protected $fillable = [
        'id',
        'nama',
        'keterangan',
        'created_at',
        'updated_at'
    ];
}
