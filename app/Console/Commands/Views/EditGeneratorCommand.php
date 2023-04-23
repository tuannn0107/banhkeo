<?php

namespace App\Console\Commands\Views;

class EditGeneratorCommand extends AbstractViewGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:edit';

    protected $type = 'Edit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin edit view';

    protected function getStub()
    {
        return base_path('stubs/edit.stub');
    }

    protected function getNameInput()
    {
        return 'edit.blade';
    }
}
