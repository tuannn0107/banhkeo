<?php

namespace App\Observers;

use App\Models\Image;
use App\Services\ImageService;

class ImageObserver
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Handle the Image "deleted" event.
     *
     * @param Image $image
     * @return void
     */
    public function deleted(Image $image): void
    {
        $this->imageService->delete($image->image);
    }
}
