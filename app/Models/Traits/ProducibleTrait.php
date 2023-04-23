<?php

namespace App\Models\Traits;

use App\Enums\ProductType as ProductTypeEnum;
use App\Models\Order;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait ProducibleTrait
{
    /**
     * The orders that belong to the product.
     */
    public function orderCollection(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }

    public function scopeNew($query)
    {
        return $query->whereIn('id', ProductType::whereName(ProductTypeEnum::NEW_ARRIVAL->value)->pluck('post_id'));
    }

    public function scopeBest($query)
    {
        return $query->whereIn('id', ProductType::whereName(ProductTypeEnum::BEST_SELLERS->value)->pluck('post_id'));
    }

    public function scopeFeatured($query)
    {
        return $query->whereIn('id', ProductType::whereName(ProductTypeEnum::FEATURED_PRODUCTS->value)->pluck('post_id'));
    }

    public function scopeSale($query)
    {
        return $query->whereIn('id', ProductType::whereName(ProductTypeEnum::ON_SALE->value)->pluck('post_id'));
    }

    public function scopeDiscount($query)
    {
        return $query->whereNotNull('sale_price');
    }

    public function getProductTypeAttribute()
    {
        return ProductType::wherePostId($this->id)->first();
    }

    public function getAmountAttribute()
    {
        return $this->pivot->quantity * $this->pivot->price;
    }

    public function getPriceCorrectedAttribute()
    {
        return $this->sale_price ?: $this->price;
    }

    public function getPriceLabelAttribute(): string
    {
        if (!$this->sale_price && !$this->price) {
            return '';
        }

        if (!$this->sale_price || !$this->price) {
            return price(max($this->price, $this->sale_price));
        }

        return '<del>' . price($this->price) . '</del> <span>' . price($this->sale_price) . '</span>';
    }

    public function getProductHrefAttribute()
    {
        return trans('slug.product') . '/' . $this->slug;
    }
}
