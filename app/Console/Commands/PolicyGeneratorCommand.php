<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\PolicyMakeCommand;

class PolicyGeneratorCommand extends PolicyMakeCommand
{
    protected function replaceModel($stub, $model)
    {
        $searches = [
            ['{{ modelPath }}'],
            ['{{modelPath}}'],
        ];

        foreach ($searches as $search) {
            $stub = str_replace($search, [str(class_basename($model))->kebab()], $stub);
        }

        return parent::replaceModel($stub, $model);
    }
}
