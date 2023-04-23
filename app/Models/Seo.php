<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    const META_LIST = ['title', 'canonical', 'description', 'robots', 'keywords', 'scripts'];

    protected $fillable = self::META_LIST;

    public function seoable()
    {
        return $this->morphTo();
    }
}
