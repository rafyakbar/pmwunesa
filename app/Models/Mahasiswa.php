<?php

namespace PMW\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public $table = 'mahasiswa';

    public $primaryKey = 'id_pengguna';

    public $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'id_proposal',
        'ipk'
    ];

    /**
     * Mendapatkan pengguna dari mahasiswa tertentu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengguna()
    {
        return $this->belongsTo('PMW\User',$this->primaryKey)->first();
    }

    /**
     * Mendapatkan undangan tim
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function undanganTimKetua()
    {
        return $this->belongsToMany('PMW\Models\Mahasiswa', 'undangan_tim', 'id_ketua', 'id_anggota');
    }

    /**
     * Mendapatkan undangan tim
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function undanganTimAnggota()
    {
        return $this->belongsToMany('PMW\Models\Mahasiswa', 'undangan_tim', 'id_anggota', 'id_ketua');
    }

    /**
     * Mendapatkan proposal dari mahasiswa tertentu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proposal()
    {
        return $this->belongsTo('PMW\Models\Proposal','id_proposal')->first();
    }

    public function punyaProposal()
    {
        return !is_null($this->proposal());
    }

    public function punyaProposalFinal()
    {
        return ($this->punyaProposal() && $this->proposal()->direktori_final);
    }

    public function punyaTim()
    {
        return !is_null($this->mahasiswa()->id_proposal);
    }

    public function ketua()
    {
        $proposal = $this->mahasiswa()->id_proposal;

        return Proposal::find($proposal)->ketua();
    }

    public function jumlahAnggotaTim()
    {
        $proposal = $this->proposal();

        return Mahasiswa::where('id_proposal', $proposal->id)->count();
    }

    public function bisaKirimUndanganTim($penerima = null)
    {
        return (($this->isAnggota() && !$this->punyaTim()) || ($this->isKetua() && $this->jumlahAnggotaTim() < 3));
    }

    public function bisaTerimaUndanganTim($pengirim = null)
    {

    }

    public function bisaKirimUndanganDosen()
    {
        return ($this->jumlahAnggotaTim() == 3);
    }

    public function tolakUndanganTim($dari)
    {
        $dari->mahasiswa()->undanganTimKetua()->where('id_anggota',$this->pengguna()->id)->first()->update([
            'ditolak' => true
        ]);
    }

    public function timLengkap()
    {
        $proposal = $this->proposal();

        return ($proposal->mahasiswa()->count() == 3);
    }

}
