<?php

namespace App\Console\Commands;

use Illuminate\Database\Console\Seeds\SeederMakeCommand;

class SeederGeneratorCommand extends SeederMakeCommand
{
    protected function replaceNamespace(&$stub, $name)
    {
        $searches = [
            ['{{ namespacedModel }}', '{{ model }}', '{{ class }}'],
            ['{{namespacedModel}}', '{{model}}', '{{class}}'],
        ];

        $class = str_replace($this->getNamespace($name) . '\\', '', $name);
        $model = str_replace('Seeder', '', $class);
        $namespacedModel = $this->qualifyModel($model);

        foreach ($searches as $search) {
            $stub = str_replace($search, [$namespacedModel, $model, $class], $stub);
        }
        return $this;
    }

    protected function rootNamespace()
    {
        return "App\\";
    }
}
