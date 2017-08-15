<?php

namespace PMW\Listeners;

use PMW\Events\UserTerdaftar;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class KirimEmailRegistrasi
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

        // Mail::to($user->email)->send(new RegisterMail($user, $this->generatedPassword));
    }
}
