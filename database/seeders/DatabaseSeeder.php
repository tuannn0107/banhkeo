<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            ConfigurationSeeder::class,
            MailConfigurationSeeder::class,
            VisitorSeeder::class,
            MasterCategorySeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            OrderSeeder::class
        ]);
    }
}
