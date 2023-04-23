<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the order that owns the contact.
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
