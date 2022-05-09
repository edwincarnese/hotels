<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.confirmation')
            ->from(config('mail.from.address'), 'Caraga Tours')
            ->replyTo($this->data['email'], $this->data['full_name'])
            ->subject('Booking Confirmation')
            ->with(['data' => $this->data]);

        return $this->view('view.name');
    }
}
