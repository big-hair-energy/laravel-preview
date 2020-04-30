<?php

namespace BigHairEnergy\Preview\Console;

use BigHairEnergy\Preview\Mail\PreviewInvitation;
use BigHairEnergy\Preview\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class InviteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preview:invite {email? : Invite a specific user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates new secret keys and emails users a preview URL';

    protected $totalSent = 0;

    protected $totalToSend = 0;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!config('preview.enabled')) {
            return;
        }

        // One user
        if ($this->argument('email')) {
            $user = User::where('email', $this->argument('email'))->first();
            $this->totalToSend = 1;
            $this->inviteUser($user);
            return $this->info($this->totalSent . ' out of ' . $this->totalToSend . ' preview invites sent');
        }

        $users = User::all();
        $this->totalToSend = $users->count();
        $users->each(function ($user) {
            $this->inviteUser($user);
        });
        return $this->info($this->totalSent . ' out of ' . $this->totalToSend . ' preview invites sent');
    }

    protected function inviteUser(User $user)
    {
        $user->generateKey();
        $user->save();

        // Send an email to the user
        try {
            Mail::mailer(config('preview.mail.default'))->to($user->email)->send(new PreviewInvitation($user->email, $user->secret_key));
            $this->totalSent++;
        } catch (Throwable $th) {
            //throw $th;
        }
    }
}
