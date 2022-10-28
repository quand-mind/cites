<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Formalitie;

class sendErrorsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Observaciones sobre su tramite";
    public $formalitie;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Formalitie $formalitie)
    {
        $this->formalitie = $formalitie;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('panel.dashboard.mail.sendErrorsMail');
    }
}
