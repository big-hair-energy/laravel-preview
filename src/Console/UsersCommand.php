<?php

namespace BigHairEnergy\Preview\Console;

use BigHairEnergy\Preview\User;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class UsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preview:users
                            {email? : The email of the user}
                            {--create : Create this user}
                            {--delete : Remove this user}
                            {--secret : Generate a new secret key for this user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays a list of preview users';

    /**
     * The table headers for the command.
     *
     * @var array
     */
    protected $headers = ['email', 'secret_key', 'ip_address', 'last_previewed_at'];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // All users
        if (!$this->argument('email')) {
            return $this->getUsers();
        }

        // Create user
        if ($this->option('create')) {
            return $this->createUser();
        }

        // Generate user secret
        if ($this->option('secret')) {
            return $this->generateUserSecret();
        }

        // Delete user
        if ($this->option('delete')) {
            return $this->deleteUser();
        }

        // Show User
        $this->displayUser($this->getUser());
    }

    protected function displayUser(User $user)
    {
        $this->displayUsers(collect([$user]));
    }

    protected function displayUsers(Collection $users)
    {
        $this->table($this->headers, $users->map(function ($user) {
            return [
                $user->email,
                $user->secret_key,
                $user->ip_address,
                $user->last_previewed_at,
            ];
        })->toArray());
    }

    protected function getUser()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();
        if (!$user) {
            throw new InvalidArgumentException('Your application doesn\'t have any preview users associated with that email.');
        }
        return $user;
    }

    protected function createUser()
    {
        $email = $this->argument('email');
        $params = [
            'email' => $email,
        ];
        $validator = Validator::make($params, [
            'email' => 'required|email:rfc,dns',
        ], [
            'email.required' => 'No email was provided for creating a preview user.',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $user = User::withTrashed()->where('email', $email)->first();

        if ($user && !$user->trashed()) {
            throw new InvalidArgumentException('The email provided already exists for a preview user.');
        }

        if (!$user) {
            $user = User::create($params);
        }

        if ($user->trashed()) {
            $user->restore();
        }

        $user->generateKey();
        return $this->displayUser($user);
    }

    protected function deleteUser()
    {
        $user = $this->getUser();
        $user->delete();
        $this->info(sprintf('The preview user with email "%s" as been deleted.', $user->email));
    }

    protected function generateUserSecret()
    {
        $user = $this->getUser()->generateKey();
        $this->displayUser($user);
    }

    protected function getUsers()
    {
        $users = User::all();
        if ($users->isEmpty()) {
            throw new InvalidArgumentException('Your application doesn\'t have any preview users.');
        }
        $this->displayUsers($users);
    }
}
