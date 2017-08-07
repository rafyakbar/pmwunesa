<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $fillable = [
        'id',
        'id_pengguna',
        'id_proposal',
        'tahap',
        'komentar',
        'created_at',
        'updated_at'
    ];

    public function penilaian()
    {
        return $this->belongsToMany('PMW\Models\Aspek', 'penilaian', 'id_review', 'id_aspek')->withPivot('nilai');
    }

    public function ubahNilai($aspek, $nilai)
    {
        $this->penilaian()->detach($aspek);
        $this->penilaian()->attach($aspek, [
            'nilai' => $nilai
        ]);
    }

}