<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class HakAksesPengguna extends Model
{
    const STATUS_REQUEST = [
        'Requesting',
        'Approved',
        'Rejected'
    ];

    const REQUESTING = 'Requesting';

    const APPROVED = 'Approved';

    const REJECTED = 'Rejected';

    public $table = 'hak_akses_pengguna';

    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'id_hak_akses',
        'status_request'
    ];
}
