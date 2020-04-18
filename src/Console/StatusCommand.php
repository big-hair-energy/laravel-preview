<?php

namespace BigHairEnergy\Preview\Console;

use Illuminate\Console\Command;

class StatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preview:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays the current status of preview mode';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $enabled = config('preview.enabled');
        $this->info('Preview mode is ' . ($enabled ? 'enabled' : 'disabled'));
    }
}
