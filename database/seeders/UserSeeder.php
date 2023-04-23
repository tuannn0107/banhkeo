<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super User',
            'email' => 'super@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Super@123')
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Admin@123')
        ]);

        User::create([
            'name' => 'Normal User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('User@123')
        ]);
    }
}
