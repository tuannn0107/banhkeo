<?php

namespace App\Console\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;

class ControllerGeneratorCommand extends ControllerMakeCommand
{
    protected function buildParentReplacements()
    {
        $parentModelClass = $this->parseModel($this->option('parent'));

        return array_merge(parent::buildParentReplacements(), [
            '{{ modelPath }}' => str(class_basename($parentModelClass))->kebab(),
            '{{modelPath}}' => str(class_basename($parentModelClass))->kebab(),
        ]);
    }

    protected function buildModelReplacements(array $replace)
    {
        $modelClass = $this->parseModel($this->option('model'));

        return array_merge(parent::buildModelReplacements($replace), [
            '{{ modelPath }}' => str(class_basename($modelClass))->kebab(),
            '{{modelPath}}' => str(class_basename($modelClass))->kebab(),
        ]);
    }
}
