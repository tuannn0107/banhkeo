<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FreshInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reinstall an application.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        foreach (Storage::directories('public') as $directory) {
            Storage::deleteDirectory($directory);
        }

        $this->call('migrate:fresh', ['--seed' => true, '--force' => true]);
        $this->call('optimize:clear');

        $this->info('Successful reinstalled!');
    }
}
