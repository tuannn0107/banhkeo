<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum ProcessType: string
{
    case PENDING = 'pending';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
    case REFUNDED = 'refunded';

    public function label(): string
    {
        return trans('message.order.' . $this->value);
    }

    public function class(): string
    {
        return match ($this) {
            self::PENDING => 'badge-light',
            self::CANCELLED => 'badge-light-danger',
            self::COMPLETED => 'badge-light-success',
            self::REFUNDED => 'badge-light-warning'
        };
    }

    public function processList(): Collection
    {
        $processList = new Collection();
        foreach (self::cases() as $orderStatusType) {
            $processList->push(json_decode(json_encode([
                'id' => $orderStatusType->value,
                'name' => $orderStatusType->label()
            ])));
        }

        return $processList;
    }
}
