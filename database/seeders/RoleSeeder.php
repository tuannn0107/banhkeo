<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superRole = Role::create(['name' => 'SUPER', 'slug' => 'super']);
        $adminRole = role::create(['name' => 'ADMIN', 'slug' => 'admin']);
        $userRole = Role::create(['name' => 'USER', 'slug' => 'user']);

        User::firstWhere('email', 'super@gmail.com')->roleList()->sync([$superRole->id, $adminRole->id, $userRole->id]);
        User::firstWhere('email', 'admin@gmail.com')->roleList()->sync([$adminRole->id, $userRole->id]);
        User::firstWhere('email', 'user@gmail.com')->roleList()->sync([$userRole->id]);
    }
}
