<?php

namespace App\Console\Commands\Admin;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use function base_path;
use function str;

class AdminGeneratorCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'admin:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin CRUD';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->call('make:model', ['name' => $name, '-m' => true, '-f' => true, '-s' => true, '--policy' => true]);
        $this->call('make:controller', ['name' => 'Admin/' . $name . 'Controller', '--model' => $name]);
        $this->call('make:request', ['name' => $name . 'Request']);
        $this->call('make:observer', ['name' => $name . 'Observer', '--model' => $name]);
//        $this->call('make:rule', ['name' => $name . 'Rule']);
        $this->call('make:index', ['name' => $name]);
        $this->call('make:create', ['name' => $name]);
        $this->call('make:edit', ['name' => $name]);

        File::append(base_path('routes/admin.php'), 'Route::resource(\'' . str($name)->kebab()
            . '\', \\App\\Http\\Controllers\\Admin\\' . $name . 'Controller::class);' . PHP_EOL);
    }

    /**
     * Get stub.
     *
     * @return string|void
     */
    protected function getStub()
    {
        //
    }
}
