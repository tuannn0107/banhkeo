<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum StageType: string
{
    case ALL = 'all';
    case PUBLISHED = 'published';
    case PENDING = 'pending';
    case DRAFT = 'draft';

    public function label(): string
    {
        return trans('message.post.' . $this->value);
    }

    public function class(): string
    {
        return match ($this) {
            self::ALL => 'fa-tv',
            self::PUBLISHED => 'fa-eye',
            self::PENDING => 'fa-clock',
            self::DRAFT => 'fa-eye-slash',
        };
    }

    public function stageList(): Collection
    {
        $stageList = new Collection();
        foreach (self::cases() as $postStatusType) {
            $stageList->push(json_decode(json_encode([
                'name' => $postStatusType->label(),
                'type' => $postStatusType->value,
                'class' => $postStatusType->class()
            ])));
        }

        return $stageList;
    }
}
