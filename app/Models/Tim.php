<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    protected $table = 'tim';

    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'id_proposal',
        'ipk'
    ];

    public function pengguna(){
        return $this->belongsTo('PMW\User');
    }

    public function proposal(){
        return $this->belongsTo('PMW\Models\Proposal');
    }
}
