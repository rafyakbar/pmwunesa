<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposal';

    protected $fillable = [
        'id',
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

    public function review(){
        return $this->hasMany('PMW\Models\Review');
    }

    public function logbook(){
        return $this->hasMany('PMW\Models\LogBook');
    }

    public function tim(){
        return $this->hasMany('PMW\Models\Tim');
    }
}
