<?php

namespace PMW;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    protected $table = 'pengguna';

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_prodi',
        'nama',
        'email',
        'alamat_asal',
        'alamat_tinggal',
        'no_telepon',
        'hak_akses',
        'password',
        'request'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function jurusan(){
        return $this->belongsTo('PMW\Models\Prodi');
    }

    public function tim(){
        return $this->has('PMW\Models\Tim');
    }

    public function review(){
        return $this->hasMany('PMW\Models\Review');
    }

    public function hakAkses(){
        return $this->belongsToMany('PMW\Models\HakAkses','hak_akses_pengguna','id_pengguna', 'id_hak_akses');
    }

    public function proposal(){
        return $this->belongsToMany('PMW\Models\Proposal','tim','id_pengguna','id_proposal')->withPivot('ipk');
    }
}
