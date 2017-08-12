<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    public $table = 'laporan';

    public $timestamps = true;

    const KEMAJUAN = 'kemajuan';

    const AKHIR = 'akhir';

    protected $fillable = [
        'id_proposal',
        'jenis',
        'direktori',
        'keterangan'
    ];

    /**
     *
     *
     * @return mixed
     */
    public function proposal()
    {
        return $this->belongsTo('PMW\Models\Proposal','id_proposal')->first();
    }

    public function kemajuan()
    {
        return $this->where('jenis', Laporan::KEMAJUAN)->first();
    }

    public function akhir()
    {
        return $this->where('jenis', Laporan::AKHIR)->first();
    }

}
