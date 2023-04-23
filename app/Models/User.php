<?php

namespace App\Models;

use App\Models\Traits\ActivableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, ActivableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isSuper(): bool
    {
        return $this->roleList->contains('slug', 'super');
    }

    public function roleList(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasPermission($name): bool
    {
        return $this->permissionList()->contains('slug', $name);
    }

    public function permissionList(): Collection
    {
        $permissionList = new Collection();
        foreach ($this->roleList as $role) {
            foreach ($role->permissionList as $permission) {
                $permissionList->push($permission);
            }
        }
        return $permissionList->unique('slug');
    }

    public function postList(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
