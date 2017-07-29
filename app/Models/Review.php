<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $fillable = [
        'id_pengguna',
        'id_proposal',
        'tahap',
        'komentar',
        'n_1',
        'n_2',
        'n_3',
        'n_4',
        'n_5',
        'n_6',
        'n_7',
        'n_8',
        'n_9',
        'n_10',
        'n_11',
        'created_at',
        'updated_at'
    ];
}
