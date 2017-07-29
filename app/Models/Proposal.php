<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposal';

    protected $fillable = [
        'lolos',
        'judul',
        'direktori',
        'usulan_dana',
        'abstrak',
        'keyword',
        'jenis_usaha',
        'created_at',
        'updated_at'
    ];
}
