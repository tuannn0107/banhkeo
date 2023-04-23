<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class DumpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dump {option?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump the sql file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $option = $this->argument('option') ?? 'all';

        if ($option == 'all') {
            $this->call('migrate:reset', ['--force' => true]);
            Schema::dropIfExists('migrations');
        }

        $sqlPath = 'sql/dump-' . $option . '.sql';

        try {
            DB::unprepared(File::get(database_path($sqlPath)));
            $this->info('Successful import from ' . $sqlPath);
        } catch (Exception $e) {
            $this->warn('Failed import from ' . $sqlPath . PHP_EOL . 'Exception: ' . $e->getMessage());
        }
    }
}
