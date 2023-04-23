<?php

namespace App\Models;

use App\Models\Traits\ActivableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, ActivableTrait;

    protected $guarded = [];

    public function roleList()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
