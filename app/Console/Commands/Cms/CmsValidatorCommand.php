<?php

namespace App\Console\Commands\Cms;

use App\Services\CmsService;
use Exception;
use Illuminate\Console\Command;
use function app;

class CmsValidatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:validate {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validate unique data-cms attribute in all .blade.php file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        try {
            $errorList = app()->make(CmsService::class)->validate($name);
            $this->warn('Duplicate data-cms: ' . json_encode($errorList->get('duplicate'), JSON_UNESCAPED_UNICODE));
            $this->warn('Content without tag: ' . json_encode($errorList->get('noTag'), JSON_UNESCAPED_UNICODE));
        } catch (Exception $e) {
            $this->warn('Validate data-cms failed' . PHP_EOL . "Exception: " . $e->getMessage());
        }
    }

    protected function getStub()
    {
        // NOP
    }
}
