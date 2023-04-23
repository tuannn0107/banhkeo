<?php

namespace Database\Seeders;

use App\Enums\MasterType;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slideCategory = Category::whereSlug(MasterType::SLIDE->value)->first();
        $slideCategoryIdArray = [];
        foreach (['home', 'product'] as $categoryType) {
            $slideCategoryIdArray[] = Category::create([
                'category_id' => $slideCategory->id,
                'name' => ucfirst($categoryType),
                'slug' => $categoryType . '-slide',
                'is_active' => $categoryType == 'home' ? 1 : 0
            ])->id;
        }

        if (app()->isLocal()) {
            foreach ($slideCategoryIdArray as $slideCategoryId) {
                Category::factory(3)->create(['category_id' => $slideCategoryId]);
            }
        }
    }
}
