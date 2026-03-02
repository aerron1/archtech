<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SenderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;

    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Archtech New Contact Form: ' . $this->formData['subject'])
                    ->replyTo($this->formData['email'])
                    ->view('emails.contact-form')
                    ->with([
                        'data' => $this->formData,
                        'name' => $this->formData['name'],
                        'email' => $this->formData['email'],
                        'subject' => $this->formData['subject'],
                        'message' => $this->formData['message'],
                    ]);
    }
}
