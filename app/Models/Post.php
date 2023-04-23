<?php

namespace App\Models;

use App\Enums\StageType;
use App\Models\Traits\CommentableTrait;
use App\Models\Traits\ImageableTrait;
use App\Models\Traits\ProducibleTrait;
use App\Models\Traits\SeoableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory, CommentableTrait, SeoableTrait, ImageableTrait, ProducibleTrait;

    protected $guarded = ['file', 'files', 'category_id'];

    const DATE_FORMAT = 'd/m/Y';

    const TIME_FORMAT = 'd/m/Y H:i';

    public function category(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCurrentUser($query)
    {
        if (!auth()->user()->isSuper()) {
            return $query->where('user_id', auth()->id());
        }
    }

    public function scopeOfStatus($query, $status)
    {
        if (StageType::PUBLISHED->value == $status) {
            return $query->published();
        } else if (StageType::PENDING->value == $status) {
            return $query->pending();
        } else if (StageType::DRAFT->value == $status) {
            return $query->draft();
        }
    }

    public function scopePublished($query)
    {
        return $query->where('is_active', 1)->where('published_at', '<=', now());
    }

    public function scopePending($query)
    {
        return $query->where('is_active', 1)->where('published_at', '>', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('is_active', 0);
    }

    public function scopeSort($query, $sort)
    {
        if ('up' == $sort) {
            return $query->orderByRaw('IFNULL(sale_price, price)');
        } else if ('down' == $sort) {
            return $query->orderByRaw('IFNULL(sale_price, price) DESC');
        } else if ('latest' == $sort) {
            return $query->orderBy('posts.created_at', 'desc');
        }
    }

    public function getHrefAttribute()
    {
        return $this->category()->first()?->href . '/' . $this->slug;
    }

    public function getTocHtmlAttribute()
    {
        return str($this->toc)->markdown();
    }

    public function getDateAttribute(): string
    {
        return Carbon::parse($this->published_at)->format(self::DATE_FORMAT);
    }

    public function getTimeAttribute(): string
    {
        return Carbon::parse($this->published_at)->format(self::TIME_FORMAT);
    }
}
