<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama'
    ];

    /**
     * Mendapatkan daftar jurusan atau jurusan tertentu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jurusan($jurusan = null)
    {
        if(!is_null($jurusan))
            return $this->hasMany('PMW\Models\Jurusan')->where('nama',$jurusan)->first();

        return $this->hasMany('PMW\Models\Jurusan');
    }

    public static function checkName($nama){
        foreach (Fakultas::all() as $item)
            if ($item->nama == $nama)
                return true;
        return false;
    }

    public static function getIdByName($nama)
    {
        return Fakultas::where('nama',$nama)->first()->id;
    }

}
