<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Aspek extends Model
{
    public $table = 'aspek';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama'
    ];
}
