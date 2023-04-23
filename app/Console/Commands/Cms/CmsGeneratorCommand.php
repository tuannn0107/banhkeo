<?php

namespace App\Console\Commands\Cms;

use App\Services\CmsService;
use Exception;
use Illuminate\Console\GeneratorCommand;
use function app;

class CmsGeneratorCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:make {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add data-cms attribute into .blade.php file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $fileName = $name ?? '*';
        try {
            app()->make(CmsService::class)->generate($name);
            $this->info('Successful added data-cms into ' . $fileName . '.blade.php');
        } catch (Exception $e) {
            $this->warn('Failed added data-cms into ' . $fileName . '.blade.php' . PHP_EOL . 'Exception: ' . $e->getMessage());
        }
    }

    protected function getStub()
    {
        // NOP
    }
}
