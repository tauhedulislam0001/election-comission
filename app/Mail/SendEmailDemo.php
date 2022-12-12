<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendEmailDemo extends Mailable
{
    use Queueable, SerializesModels;
    public $send_mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($send_mail)
    {
        $this->send_mail = $send_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $path_file= $this->send_mail;
        return $this->subject('Garibook.com: Your booking has been placed successfully.')
            ->view('garibook.passMail')->attach($path_file);
            // unlink($path_file);

    }
}
