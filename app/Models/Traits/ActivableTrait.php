<?php

namespace App\Models\Traits;

use App\Enums\StatusType;

trait ActivableTrait
{
    public function getActiveClassAttribute(): string
    {
        return StatusType::from($this->is_active)->class();
    }

    public function getActiveLabelAttribute(): string
    {
        return StatusType::from($this->is_active)->label();
    }
}
