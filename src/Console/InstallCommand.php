<?php

namespace BigHairEnergy\Preview\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preview:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Preview resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Preview Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'preview-provider']);

        $this->comment('Publishing Preview Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'preview-assets']);

        $this->comment('Publishing Preview Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'preview-config']);

        $this->info('Preview scaffolding installed successfully.');
    }
}
