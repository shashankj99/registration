<?php

namespace App\Mail;

use App\ActivationCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    public function __construct(ActivationCode $code) {
        $this->code = $code->code;
    }

    public function build() {
        return $this->view('emails.user_activation')->with('code', $this->code);
    }
}
