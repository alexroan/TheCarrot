<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    private $title;
    private $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo(
            Auth::user()->email,
            Auth::user()->name
        )
        ->view(
            'contactus',
            [
                'title' => $this->title,
                'content' => $this->content
            ]
        );
    }
}
