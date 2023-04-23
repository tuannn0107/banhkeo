<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum ProductType: string
{
    case NEW_ARRIVAL = 'new';
    case BEST_SELLERS = 'best';
    case FEATURED_PRODUCTS = 'featured';
    case ON_SALE = 'sale';

    public function label(): string
    {
        return trans(match ($this) {
            self::NEW_ARRIVAL => 'New Arrival',
            self::BEST_SELLERS => 'Best Sellers',
            self::FEATURED_PRODUCTS => 'Featured Products',
            self::ON_SALE => 'On Sale',
        });
    }

    public function productTypeList(): Collection
    {
        $productTypeList = new Collection();
        $productTypeList->push(json_decode(json_encode([
            'id' => self::FEATURED_PRODUCTS->value,
            'name' => self::FEATURED_PRODUCTS->label()
        ])));

        return $productTypeList;
    }
}
