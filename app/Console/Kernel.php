<?php

namespace App\Console;

use App\Console\Commands\Views\CreateGeneratorCommand;
use App\Console\Commands\Views\EditGeneratorCommand;
use App\Console\Commands\Views\IndexGeneratorCommand;
use App\Services\VisitorService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        IndexGeneratorCommand::class,
        CreateGeneratorCommand::class,
        EditGeneratorCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * Default run every minute.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('queue:work --max-jobs=10')->everyMinute();
        $schedule->command('queue:retry all')->name('queue')->withoutOverlapping(60)->hourly();

        $schedule->call(function () {
            $this->app->make(VisitorService::class)->fetchAndSaveLocation();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
