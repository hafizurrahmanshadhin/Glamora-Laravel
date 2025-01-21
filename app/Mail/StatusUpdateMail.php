<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusUpdateMail extends Mailable {
    use Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function build() {
        return $this
            ->subject('Your Status Has Changed')
            ->view('emails.status-changed');
    }
}
