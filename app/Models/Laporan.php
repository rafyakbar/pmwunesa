<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    public $table = 'laporan';

    public $timestamps = false;

    const KEMAJUAN = 'kemajuan';

    const AKHIR = 'akhir';

    protected $fillable = [
        'id_proposal',
        'jenis',
        'direktori',
        'keterangan'
    ];

    public function proposal()
    {
        return $this->belongsTo('PMW\Models\Proposal');
    }
}
