<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Formalitie;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Cambio de Contraseña";
    public $token;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        $this->url = config('app.url');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.passwordReset');
    }
}
