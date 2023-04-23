<?php

namespace App\Models;

use App\Enums\ProcessType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the contact associated with the order.
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Call $order->productList
     *
     * The products that belong to the order.
     */
    public function productList(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'order_products')->withPivot('price', 'quantity');
    }

    public function getAmountAttribute()
    {
        return OrderProduct::whereOrderId($this->id)->get()->sum(function ($order) {
            return $order->quantity * $order->price;
        });
    }

    public function getStatusLabelAttribute(): string
    {
        return ProcessType::from($this->status)->label();
    }

    public function getStatusClassAttribute(): string
    {
        return ProcessType::from($this->status)->class();
    }
}
