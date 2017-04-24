<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function build() {
        return $this->view('email.password')->with([
            'email_token' => $this->data['email_token'],
        ])->subject('Reset Password');
    }
}
