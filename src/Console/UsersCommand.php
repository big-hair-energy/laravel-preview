<?php

namespace BigHairEnergy\Preview\Console;

use BigHairEnergy\Preview\User;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class UsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preview:users {email?}';

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
    protected $headers = ['email', 'secret_key', 'ip_address', 'last_previewed'];

    /**
     * The columns to display when using the "compact" flag.
     *
     * @var array
     */
    protected $compactColumns = ['email', 'secret_key'];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();
        dd($users);
        if ($users->isEmpty()) {
            return $this->error('Your application doesn\'t have any preview users.');
        }

        if ($this->option('json')) {
            return $this->line(json_encode(array_values($users)));
        }

        $this->table($this->getHeaders(), $users);
    }

    /**
     * Get the table headers for the visible columns.
     *
     * @return array
     */
    protected function getHeaders()
    {
        return Arr::only($this->headers, array_keys($this->getColumns()));
    }

    /**
     * Get the column names to show (lowercase table headers).
     *
     * @return array
     */
    protected function getColumns()
    {
        $availableColumns = array_map('strtolower', $this->headers);

        if ($this->option('compact')) {
            return array_intersect($availableColumns, $this->compactColumns);
        }

        if ($columns = $this->option('columns')) {
            return array_intersect($availableColumns, $this->parseColumns($columns));
        }

        return $availableColumns;
    }

    /**
     * Parse the column list.
     *
     * @param  array  $columns
     * @return array
     */
    protected function parseColumns(array $columns)
    {
        $results = [];

        foreach ($columns as $i => $column) {
            if (Str::contains($column, ',')) {
                $results = array_merge($results, explode(',', $column));
            } else {
                $results[] = $column;
            }
        }

        return $results;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['columns', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Columns to include in the preview users table'],
            ['compact', 'c', InputOption::VALUE_NONE, 'Only show email and secret key columns'],
            ['json', null, InputOption::VALUE_NONE, 'Output the user list as JSON'],
            ['email', null, InputOption::VALUE_OPTIONAL, 'Filter the users by email'],
            ['secret_key', null, InputOption::VALUE_OPTIONAL, 'Filter the users by secret key'],
            ['reverse', 'r', InputOption::VALUE_NONE, 'Reverse the ordering of the users'],
            ['sort', null, InputOption::VALUE_OPTIONAL, 'The column (email, secret_key, ip_address, last_previewed) to sort by', 'email'],
        ];
    }
}
