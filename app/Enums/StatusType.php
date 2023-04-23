<?php

namespace App\Enums;

enum StatusType: int
{
    case ACTIVE = 1;
    case INACTIVE = 0;

    public function label(): string
    {
        return trans(match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        });
    }

    public function class(): string
    {
        return match ($this) {
            self::ACTIVE => 'badge-light-success',
            self::INACTIVE => 'badge-light-danger',
        };
    }
}
