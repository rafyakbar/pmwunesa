<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    protected $table = 'logbook';

    protected $fillable = [
        'id_proposal',
        'catatan',
        'biaya',
        'created_at',
        'updates_at'
    ];
}
