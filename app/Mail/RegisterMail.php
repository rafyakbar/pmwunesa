<?php

namespace PMW\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ini digunakan untuk melakukan pengiriman email
 * kepada user yang telah melakukan pendaftaran
 */
class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.register',[
            'user' => $this->user,
            'password' => $this->password
        ]);
    }
}
