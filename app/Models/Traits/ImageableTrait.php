<?php

namespace App\Models\Traits;

use App\Models\Image;

trait ImageableTrait
{
    public static function bootImageableTrait(): void
    {
        static::deleting(function ($model) {
            $model->imageList()->delete();
        });
    }

    public function imageList()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
