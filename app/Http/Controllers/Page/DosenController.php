<?php

namespace PMW\Http\Controllers\Page;

use PMW\Http\Controllers\Controller;
use PMW\Models\Aspek;
use Illuminate\Support\Facades\Auth;
use PMW\Support\RequestStatus;

class DosenController extends Controller
{

    public function bimbingan()
    {
        return view('dosen.pembimbing.bimbingan',[
            'bimbingan' => Auth::user()->bimbingan(RequestStatus::APPROVED)
        ]);
    }

}
