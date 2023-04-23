<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $bladeFileList = File::files(resource_path('views/includes'));
        foreach ($bladeFileList as $bladeFile) {
            $fileName = str($bladeFile->getFilename())->before('.blade.php');
            Blade::include('includes.' . $fileName, str($fileName)->camel()->toString());
        }
    }
}
