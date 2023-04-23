<?php

namespace App\Console\Commands\Views;

use Illuminate\Console\GeneratorCommand;

abstract class AbstractViewGeneratorCommand extends GeneratorCommand
{
    protected function getPath($name)
    {
        return str(parent::getPath($name))->replaceFirst('app/', '');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\resources\\views\\admin\\' . str($this->argument('name'))->kebab();
    }

    protected function replaceNamespace(&$stub, $name)
    {
        $searches = [
            ['{{ model }}', '{{ modelVariable }}', '{{ modelPath }}'],
            ['{{model}}', '{{modelVariable}}', '{{modelPath}}'],
        ];

        $modelClass = class_basename($this->getNamespace($name));

        foreach ($searches as $search) {
            $stub = str_replace(
                $search,
                [ucfirst($modelClass), str($modelClass)->camel(), str($modelClass)->kebab()],
                $stub
            );
        }

        return $this;
    }
}
