<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;

class Dropify extends AbstractComponent
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.dropify');
    }
}
