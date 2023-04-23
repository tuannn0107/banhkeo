<?php

namespace App\Console\Commands\Views;

class CreateGeneratorCommand extends AbstractViewGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:create';

    protected $type = 'Create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin create view';

    protected function getStub()
    {
        return base_path('stubs/create.stub');
    }

    protected function getNameInput()
    {
        return 'create.blade';
    }
}
