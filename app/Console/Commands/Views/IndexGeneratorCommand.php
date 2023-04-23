<?php

namespace App\Console\Commands\Views;

class IndexGeneratorCommand extends AbstractViewGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:index';

    protected $type = 'Index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin index view';

    protected function getStub()
    {
        return base_path('stubs/index.stub');
    }

    protected function getNameInput()
    {
        return 'index.blade';
    }
}
