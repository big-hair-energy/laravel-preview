<?php

namespace BigHairEnergy\Preview\Mail;

use BigHairEnergy\Preview\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class PreviewInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $secret_key;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $email, string $secretKey)
    {
        $this->email = $email;
        $this->secret_key = $secretKey;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[' . config('app.name') .'] ' . Str::title(config('app.env')) . ' Preview')
            ->view('preview::emails.invite')
            ->text('preview::emails.invite_plain');
    }
}
