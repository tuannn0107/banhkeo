<?php

namespace App\Models;

use App\Models\Traits\ActivableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, ActivableTrait;

    protected $guarded = ['permissionList'];

    public function userList()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }

    public function permissionList()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
