<?php

namespace App\Models;

use App\Models\Scopes\SortScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['type', 'file', 'files'];

    const OTHER = ['slide', 'testimony'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new SortScope);
    }

    /**
     * Call Category::masterList()->get()
     *
     * @param $query
     * @param string $master
     * @return Builder|HasMany
     */
    public function scopeMasterList($query, string $master = 'master'): Builder|HasMany
    {
        if (collect(['master', 'category'])->contains($master)) {
            return $query->whereNull('category_id');
        }

        return $query->whereSlug($master)->first()->childList();
    }

    /**
     * Call Category::active()->get()
     *
     * @param $query
     * @return Builder
     */
    public function scopeActive($query): Builder
    {
        return $query->whereIsActive(1);
    }

    /**
     * Call $category->master()
     *
     * @return Category
     */
    public function master(): Category
    {
        if (!$this->category_id) {
            return $this;
        }

        return $this->parent->master();
    }

    /**
     * Call $category->parent
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id')->with('parent');
    }

    /**
     * Call $category->childList
     *
     * @return HasMany
     */
    public function childList(): HasMany
    {
        return $this->hasMany(Category::class)->with('childList');
    }

    /**
     * Call $category->descendantList()
     *
     * @return Collection
     */
    public function descendantList(): Collection
    {
        $descendantList = new Collection();

        foreach ($this->childList as $child) {
            $descendantList->push($child);
            $descendantList = $descendantList->merge($child->descendantList());
        }

        return $descendantList;
    }

    /**
     * Call Category::has('postList')->get()
     *
     * Get all category list has post
     *
     * @return MorphToMany
     */
    public function postList(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'categoryable');
    }

    /**
     * Call $category->descendantPostList()->get()
     *
     * @return mixed
     */
    public function descendantPostList(): mixed
    {
        return Post::whereHas('category', function (Builder $query) {
            $query->whereIn('id', $this->descendantIdList());
        });
    }

    /**
     * Call $category->descendantIdList()
     *
     * @return Collection
     */
    public function descendantIdList(): Collection
    {
        return $this->descendantList()->prepend($this)->pluck('id');
    }

    /**
     * Call $category->href
     *
     * @return string
     */
    public function getHrefAttribute(): string
    {
        return '/' . $this->slug;
    }

    /**
     * Call $category->excerpt
     *
     * @return string
     */
    public function getExcerptAttribute(): string
    {
        return str($this->content)->limit();
    }

    /**
     * Call $category->name_corrected
     *
     * @return string
     */
    public function getNameCorrectedAttribute(): string
    {
        if (str($this->name)->startsWith('empty_')) {
            return '';
        }

        return $this->name;
    }

    /**
     * Call $category->slug_corrected
     *
     * @return string
     */
    public function getSlugCorrectedAttribute(): string
    {
        if (str($this->slug)->startsWith('empty_')) {
            return '';
        }

        return $this->slug;
    }

    /**
     * Call $category->parent_slug_corrected
     *
     * @return string
     */
    public function getParentSlugCorrectedAttribute(): string
    {
        return str($this->parent->slug)->after('-');
    }
}
