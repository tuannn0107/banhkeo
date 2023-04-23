<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum LanguageType: string
{
    case EN = 'en';
    case VI = 'vi';

    public function label(): string
    {
        return trans(match ($this) {
            self::EN => 'English',
            self::VI => 'Vietnamese',
        });
    }

    public function languageList(): Collection
    {
        $languageList = new Collection();
        foreach (self::cases() as $language) {
            $languageList->push(json_decode(json_encode([
                'id' => $language->value,
                'name' => $language->label()
            ])));
        }

        return $languageList;
    }
}
