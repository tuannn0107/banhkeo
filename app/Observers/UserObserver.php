<?php

namespace App\Observers;

use App\Models\User;
use App\Services\ImageService;

class UserObserver
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user): void
    {
        if ($user->getOriginal('image') && $user->isDirty('image')) {
            $this->imageService->delete($user->getOriginal('image'));
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user): void
    {
        $this->imageService->delete($user->image);
    }
}
