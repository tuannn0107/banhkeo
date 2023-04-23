<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'User', 'slug' => 'user'],
            ['name' => 'Role', 'slug' => 'role'],
            ['name' => 'Permission', 'slug' => 'permission'],
            ['name' => 'System', 'slug' => 'system'],
            ['name' => 'Visitor', 'slug' => 'visitor'],
            ['name' => 'Testimony', 'slug' => 'testimony'],
            ['name' => 'Comment', 'slug' => 'comment']
        ]);

        $adminPermissionList = [
            ['name' => 'Category', 'slug' => 'category'],
            ['name' => 'Cms', 'slug' => 'cms'],
            ['name' => 'Configuration', 'slug' => 'configuration'],
            ['name' => 'Image', 'slug' => 'image'],
            ['name' => 'Page', 'slug' => 'page'],
            ['name' => 'Seo', 'slug' => 'seo'],
            ['name' => 'Slide', 'slug' => 'slide'],
            ['name' => 'Order', 'slug' => 'order']
        ];

        $userPermissionList = [
            ['name' => 'Contact', 'slug' => 'contact'],
            ['name' => 'Post', 'slug' => 'post']
        ];

        $adminPermissionIdList = [];
        $userPermissionIdList = [];

        foreach ($adminPermissionList as $permission) {
            $adminPermissionIdList[] = Permission::create($permission)->id;
        }

        foreach ($userPermissionList as $permission) {
            $permissionId = Permission::create($permission)->id;
            $adminPermissionIdList[] = $permissionId;
            $userPermissionIdList[] = $permissionId;
        }

        Role::firstWhere('slug', 'admin')->permissionList()->sync($adminPermissionIdList);
        Role::firstWhere('slug', 'user')->permissionList()->sync($userPermissionIdList);
    }
}
