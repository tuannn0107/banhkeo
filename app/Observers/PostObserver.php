<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\ImageService;
use App\Services\PostService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    private PostService $postService;
    private ImageService $imageService;

    public function __construct(ImageService $imageService, PostService $postService)
    {
        $this->imageService = $imageService;
        $this->postService = $postService;
    }

    /**
     * Handle the post "creating" event.
     *
     * @param Post $post
     * @return void
     */
    public function creating(Post $post): void
    {
        $this->adding($post);
        Cache::forget('pageList');
    }

    /**
     * Handle the post "updating" event.
     *
     * @param Post $post
     * @return void
     */
    public function updating(Post $post): void
    {
        $this->adding($post);
    }

    /**
     * Handle the post "updated" event.
     *
     * @param Post $post
     * @return void
     */
    public function updated(Post $post): void
    {
        if ($post->getOriginal('image') && $post->isDirty('image')) {
            $this->imageService->delete($post->getOriginal('image'));
        }

        Cache::forget('pageList');
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param Post $post
     * @return void
     */
    public function deleted(Post $post): void
    {
        $post->category()->detach();
        $this->imageService->deleteDirectory(config('constants.folder.post') . $post->id);
        Cache::forget('pageList');
    }

    private function adding(Post $post): void
    {
        $this->castDateTime($post);
        $post->excerpt = $post->excerpt ?? str(html_entity_decode($post->content))->stripTags()->limit();
        $post->toc = $this->postService->toc($post->content);
    }

    private function castDateTime(Post $post): void
    {
        if (!$post->published_at) {
            $post->published_at = now();
        } else if (is_string($post->published_at)) {
            $post->published_at = Carbon::createFromFormat(Post::TIME_FORMAT, $post->published_at);
        }
    }
}
