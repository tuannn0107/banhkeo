<?php

namespace App\Enums;

enum SortType: string
{
    case DEFAULT = 'default';
    case LATEST = 'latest';
    case PRICE_UP = 'up';
    case PRICE_DOWN = 'down';

    public function label(): string
    {
        return trans('message.sort.' . $this->value);
    }
}
