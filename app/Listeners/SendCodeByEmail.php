<?php

namespace App\Listeners;

use App\Events\ActivationCodeEvent;
use App\Mail\ActivationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCodeByEmail
{

    public function __construct() {
        //
    }

    public function handle(ActivationCodeEvent $event) {
        Mail::to($event->user)->queue(new ActivationMail($event->user->userActivationCode));
    }
}
