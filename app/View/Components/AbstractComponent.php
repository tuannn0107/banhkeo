<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

abstract class AbstractComponent extends Component
{
    public ?string $name;
    public mixed $value;
    public ?string $label;
    public string $type;
    public bool $required;
    public string $accept;
    public int $rows;
    public int $cols;
    public bool $checked;
    public string $class;
    public ?string $hint;
    public ?string $inputClass;
    public ?string $autocomplete;
    public bool $autoSubmit;
    public Collection $optionList;
    public bool $multiple;
    public bool $countCharacter;
    public int $maxlength;

    /**
     * Create a new component instance.
     *
     * @param ?string $name
     * @param ?string $label
     * @param string $type
     * @param bool $required
     * @param string $accept
     * @param bool $checked
     * @param string $class
     * @param int $maxlength
     * @param int $rows
     * @param int $cols
     * @param ?string $inputClass
     * @param ?string $hint
     * @param mixed $value
     * @param ?string $autocomplete
     * @param bool $autoSubmit
     * @param Collection $optionList
     * @param bool $multiple
     * @param bool $countCharacter
     */
    public function __construct(?string $name = null, ?string $label = null, string $type = 'text', bool $required = false,
                                string  $accept = 'image/*', bool $checked = false, string $class = 'mb-5', int $maxlength = 190,
                                int     $rows = 2, int $cols = 3, ?string $inputClass = null, ?string $hint = null, mixed $value = null,
                                string  $autocomplete = null, bool $autoSubmit = false, Collection $optionList = new Collection,
                                bool    $multiple = false, bool $countCharacter = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->type = $type;
        $this->required = $required;
        $this->accept = $accept;
        $this->checked = $checked;
        $this->rows = $rows;
        $this->cols = $cols;
        $this->class = $class;
        $this->maxlength = $maxlength;
        $this->hint = $hint;
        $this->inputClass = $inputClass;
        $this->autocomplete = $autocomplete;
        $this->autoSubmit = $autoSubmit;
        $this->optionList = $optionList;
        $this->multiple = $multiple;
        $this->countCharacter = $countCharacter;
    }
}
