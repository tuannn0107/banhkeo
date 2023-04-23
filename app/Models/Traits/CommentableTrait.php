<?php

namespace App\Models\Traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CommentableTrait
{
    public function commentList(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id');
    }
}
