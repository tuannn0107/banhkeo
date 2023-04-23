<?php

namespace App\Console\Commands\Admin;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use function app_path;
use function database_path;
use function resource_path;

class AdminRemoveCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'admin:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the admin CRUD';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        File::delete(app_path('Models/' . $name . '.php'));
        File::delete(app_path('Rules/' . $name . 'Rule.php'));
        File::delete(app_path('Observers/' . $name . 'Observer.php'));
        File::delete(app_path('Policies/' . $name . 'Policy.php'));
        File::delete(app_path('Http/Requests/' . $name . 'Request.php'));
        File::delete(app_path('Http/Controllers/Admin/' . $name . 'Controller.php'));
        File::deleteDirectory(resource_path('views/admin/' . str($name)->kebab()));
        File::delete(database_path('factories/' . $name . 'Factory.php'));
        File::delete(database_path('seeders/' . $name . 'Seeder.php'));
        File::delete(File::glob(database_path('migrations/*_create_' . str(class_basename($name))->pluralStudly()->snake() . '_table.php')));
        $this->info('The admin CRUD removed successfully.');
    }

    protected function getStub()
    {
        //
    }
}
