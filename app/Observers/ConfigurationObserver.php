<?php

namespace App\Observers;

use App\Models\Configuration;
use App\Services\ImageService;
use Illuminate\Support\Facades\Cache;

class ConfigurationObserver
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Handle the configuration "creating" event.
     *
     * @param Configuration $configuration
     * @return void
     */
    public function created(Configuration $configuration): void
    {
        Cache::forget('config');
        Cache::forget('cmsList');
    }

    /**
     * Handle the configuration "updating" event.
     *
     * @param Configuration $configuration
     * @return void
     */
    public function updated(Configuration $configuration): void
    {
        Cache::forget('config');
        Cache::forget('cmsList');
        $this->imageService->delete($configuration->getOriginal('content'));
    }

    /**
     * Handle the cms "deleted" event.
     *
     * @param Configuration $configuration
     * @return void
     */
    public function deleted(Configuration $configuration): void
    {
        Cache::forget('config');
        Cache::forget('cmsList');
        $this->imageService->delete($configuration->content);
    }
}
