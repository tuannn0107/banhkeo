<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['type', 'name', 'content'];

    public function getExcerptAttribute(): string
    {
        return str($this->content)->limit();
    }
}
