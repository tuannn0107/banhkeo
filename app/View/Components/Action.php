<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
    public $route;
    public $id;
    public bool $enabledShow;
    public bool $enabledEdit;
    public bool $enabledDelete;

    /**
     * Create a new component instance.
     *
     * @param $route
     * @param $id
     * @param bool $enabledShow
     * @param bool $enabledEdit
     * @param bool $enabledDelete
     */
    public function __construct($route, $id, bool $enabledShow = false, bool $enabledEdit = true, bool $enabledDelete = true)
    {
        $this->route = $route;
        $this->id = $id;
        $this->enabledShow = $enabledShow;
        $this->enabledEdit = $enabledEdit;
        $this->enabledDelete = $enabledDelete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.action');
    }
}
