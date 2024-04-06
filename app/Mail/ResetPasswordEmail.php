<?php
// app/Mail/ResetPasswordEmail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetLink;
    public $verificationCode; // Add this variable for the verification code

    public function __construct($resetLink, $verificationCode)
    {
        $this->resetLink = $resetLink;
        $this->verificationCode = $verificationCode;
    }

    public function build()
    {
        return $this->view('emails.reset-password')
            ->with([
                'resetLink' => $this->resetLink,
                'verificationCode' => $this->verificationCode,
            ])
            ->subject('Reset Your Password');
    }
}
