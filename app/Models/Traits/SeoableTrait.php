<?php

namespace App\Models\Traits;

use App\Models\Seo;

trait SeoableTrait
{
    public static function bootSeoableTrait()
    {
        static::deleting(function ($model) {
            $model->seo()->delete();
        });
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
