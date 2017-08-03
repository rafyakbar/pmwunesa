<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    const STATUS_REQUEST = [
        'Requesting',
        'Approved',
        'Rejected'
    ];

    const REQUESTING = 'Requesting';

    const APPROVED = 'Approved';

    const REJECTED = 'Rejected';

    public $table = 'bimbingan';

    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'id_proposal',
        'status_request'
    ];
}
