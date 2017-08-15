<?php

namespace PMW\Listeners;

use PMW\Events\UserTerdaftar;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use PMW\Models\Mahasiswa;
use PMW\User;
use PMW\Models\HakAkses;
use PMW\Support\RequestStatus;

class SetHakAkses
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserTerdaftar  $event
     * @return void
     */
    public function handle(UserTerdaftar $event)
    {
        $user = $event->user;

        if(strlen((string) $user->id) == 11)
        {
            // Set user sebagai mahasiswa
            Mahasiswa::create([
                'id_pengguna' => $user->id,
                'ipk' => 0
            ]);

            // Mengatur hak akses sebagai anggota
            $user->hakAksesPengguna()
                ->attach(HakAkses::where('nama',HakAkses::ANGGOTA)->first(),[
                    'status_request' => RequestStatus::APPROVED
                ]);
        }
        else if(strlen((string) $user->id) == 18 || strlen((string) $user->id))
        {
            // jika panjang id sesuai panjang NIP atau NIDN
            $user->update([
                'request' => true
            ]);
        }
    }
}
