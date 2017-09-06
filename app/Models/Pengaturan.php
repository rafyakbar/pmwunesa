<?php

namespace PMW\Models;

use Carbon\Carbon;
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

    public static function nilaiMinimumProposal()
    {
        return static::where(
            'nama',
            'Nilai minimum proposal')
            ->first()
            ->keterangan;
    }

    public static function batasUnggahProposal()
    {
        return static::where(
            'nama',
            'Batas pengumpulan proposal')
            ->first()
            ->keterangan;
    }

    public static function batasPenilaian($tahap)
    {
        return static::where(
            'nama',
            'Batas penilaian proposal tahap ' . $tahap)
            ->first()
            ->keterangan;
    }

    public static function melewatiBatasUnggahProposal()
    {
        return (Carbon::now()->diffInDays(
                Carbon::parse(static::batasUnggahProposal()), false
            ) <= 0);
    }

    public static function melewatiBatasPenilaian($tahap)
    {
        return (Carbon::now()->diffInDays(
                Carbon::parse(static::batasPenilaian($tahap)
                ), false) <= 0);
    }

}
