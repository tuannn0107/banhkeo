<?php

namespace Database\Seeders;

use App\Enums\MasterType;
use App\Models\Category;
use Illuminate\Database\Seeder;

class MasterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masterCategoryList = [];
        foreach (MasterType::cases() as $masterCategoryType) {
            $masterCategoryList[] = [
                'name' => $masterCategoryType->label(),
                'slug' => $masterCategoryType->value,
                'is_active' => $masterCategoryType->isActive()
            ];
        }

        Category::insert($masterCategoryList);
    }
}
