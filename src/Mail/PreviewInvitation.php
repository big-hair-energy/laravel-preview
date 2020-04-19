<?php

namespace BigHairEnergy\Mail;

// use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class PreviewInvitation extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name');
    }
}
