<?php

namespace PMW\Http\Controllers\Page;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PMW\Support\RequestStatus;
use PMW\Http\Controllers\Controller;

/**
 * Class DashboardController
 * Class ini berfungsi untuk menampilkan halaman dasbor
 * sesuai dengan hak akses penggunanya
 *
 * @package PMW\Http\Controllers\Page
 * @author BagasMuharom <bagashidayat@mhs.unesa.ac.id|bagashidayat45@gmail.com>
 */
class DashboardController extends Controller
{

    /**
     * Mengecek jenis pengguna dan mecocokkan halaman
     * dasbor sesuai hak aksesnya
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        if(Auth::user()->isSuperAdmin())
            return $this->superAdmin();
        else if(Auth::user()->isAdminUniversitas())
            return $this->adminUniversitas();
        else if(Auth::user()->isAdminFakultas())
            return $this->adminFakultas();
        else if(Auth::user()->isDosenPembimbing())
            return $this->dosen();
        else if(Auth::user()->isReviewer())
            return $this->reviewer();
        else if(Auth::user()->isMahasiswa())
            return $this->mahasiswa();
        else
            return $this->tanpaHakAkses();
    }

    /**
     * Halaman dasbor untuk mahasiswa
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mahasiswa()
    {
        return view('mahasiswa.dashboard', [
            'undangan' => Auth::user()->mahasiswa()->undanganTimAnggota(),
        ]);
    }

    public function reviewer()
    {
        return redirect()->route('daftar.proposal.reviewer');
    }

    /**
     * Halaman dasbor untuk dosen pembimbing
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dosen()
    {
       return view('dosen.dashboard',[
           'undangan' => Auth::user()->bimbingan()->where('status_request', RequestStatus::REQUESTING),
           'bimbingan' => Auth::user()->bimbingan()->where('status_request', RequestStatus::APPROVED)->limit(3)
       ]);
    }

    /**
     * Halaman dasbor untuk admin fakultas
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminFakultas()
    {
        return view('admin.fakultas.dashboard');
    }

    /**
     * Halaman dasbor untuk admin universitas
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminUniversitas()
    {
        return view('admin.univ.dashboard');
    }

    /**
     * Halaman dasbor untuk superadmin
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function superAdmin()
    {
        return view('admin.super.dashboard');
    }

    /**
     * Halaman dasbor untuk pengguna yang belum memiliki hak akses
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function tanpaHakAkses()
    {
        if(is_null(Auth::user()->nama)) {
            Session::flash('message', 'Pastikan anda melengkapi profil terlebih dahulu');
            Session::flash('error', true);
            return redirect()->route('pengaturan');
        }

        return view('dashboard');
    }

}
