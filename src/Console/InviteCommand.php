<?php

namespace BigHairEnergy\Preview\Console;

use BigHairEnergy\Preview\User;
use Illuminate\Console\Command;

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

        $users = User::all();
        $users->each(function ($user) {
            $user->generateKey();
            $user->save();

            // Send an email to the user
            Mail::mailer(config('preview.mail.default'))
                ->to($user->email)
                ->send(new OrderShipped($order));
        });


        // TODO Loop through active users and generate new secret keys and send out emails
        $this->info('Preview mode is ' . ($enabled ? 'enabled' : 'disabled'));
    }
}
