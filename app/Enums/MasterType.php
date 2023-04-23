<?php

namespace App\Enums;

use App\Models\Category;

enum MasterType: string
{
    case CATEGORY = 'category';
    case SLIDE = 'slide';
    case PRODUCT = 'product';
    case POST = 'post';
    case PAGE = 'page';
    case TESTIMONY = 'testimony';

    public function category(): self
    {
        return collect(Category::OTHER)->contains($this->value) ? $this : self::CATEGORY;
    }

    public function isActive(): int
    {
        return match ($this) {
            self::CATEGORY,
            self::SLIDE,
            self::TESTIMONY => 0,
            default => 1
        };
    }

    public function label()
    {
        return ucfirst($this->value);
    }

    public function newLabel(): string
    {
        return trans('message.new', ['name' => trans($this->label())]);
    }

    public function editLabel(): string
    {
        return trans('message.edit', ['name' => trans($this->label())]);
    }

    public function allLabel(): string
    {
        return trans('message.all', ['name' => trans(str($this->label())->plural()->toString())]);
    }
}
