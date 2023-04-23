<?php

namespace App\Console\Commands\Admin;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AdminCopyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:copy {modelFrom} {modelTo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copies an existing admin CRUD';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelFrom = $this->argument('modelFrom');
        $modelTo = $this->argument('modelTo');

        $pathList = [
            app_path('Models/' . $modelFrom . '.php'),
            app_path('Rules/' . $modelFrom . 'Rule.php'),
            app_path('Observers/' . $modelFrom . 'Observer.php'),
            app_path('Policies/' . $modelFrom . 'Policy.php'),
            app_path('Http/Requests/' . $modelFrom . 'Request.php'),
            app_path('Http/Controllers/Admin/' . $modelFrom . 'Controller.php'),
            database_path('factories/' . $modelFrom . 'Factory.php'),
            database_path('seeders/' . $modelFrom . 'Seeder.php')
        ];

        $bladePathList = [];
        if (File::exists(resource_path('views/admin/' . str($modelFrom)->kebab()))) {
            $bladeFileList = File::files(resource_path('views/admin/' . str($modelFrom)->kebab()));
            foreach ($bladeFileList as $bladeFile) {
                $bladePathList[] = $bladeFile->getPath() . '/' . $bladeFile->getFilename();
            }
        }

        $tableList = File::glob(database_path('migrations/*_create_' . str($modelFrom)->pluralStudly()->snake() . '_table.php'));

        $this->copy($modelFrom, $modelTo, array_merge($pathList, $bladePathList, $tableList));

        File::append(base_path('routes/admin.php'), 'Route::resource(\'' . str($modelTo)->kebab()
            . '\', \\App\\Http\\Controllers\\Admin\\' . $modelTo . 'Controller::class);' . PHP_EOL);

        $this->info('The admin CRUD copied successfully.');
    }

    private function copy($modelFrom, $modelTo, $pathList)
    {
        foreach ($pathList as $path) {
            if (File::exists($path)) {
                $folder = str($this->getContent($modelTo, $this->getStub($modelFrom, $path)))->beforeLast('/');
                if (str($path)->contains('.blade.php') && !File::exists($folder)) {
                    File::makeDirectory($folder, 0755, true);
                }

                $stubFilePath = $this->getStub($modelFrom, $path);
                $stubContent = $this->getStub($modelFrom, File::get($path));

                File::put($this->getContent($modelTo, $stubFilePath), $this->getContent($modelTo, $stubContent));
            }
        }
    }

    private function getStub($model, $stub)
    {
        $search = [
            str($model)->pluralStudly()->snake(),
            str($model)->kebab() . '.',
            str($model)->kebab() . '/',
            "hasPermission('" . str($model)->kebab() . "')",
            'route="' . str($model)->kebab() . '"',
            $model,
            str($model)->camel()
        ];
        $replace = [
            '{{table}}',
            '{{slug}}.',
            '{{slug}}/',
            "hasPermission('{{slug}}')",
            'route="{{slug}}"',
            '{{model}}',
            '{{variable}}'
        ];

        return str_replace($search, $replace, $stub);
    }

    private function getContent($model, $stub)
    {
        $search = ['{{model}}', '{{slug}}', '{{table}}', '{{variable}}'];
        $replace = [$model, str($model)->kebab(), str($model)->pluralStudly()->snake(), str($model)->camel()];

        return str_replace($search, $replace, $stub);
    }
}
