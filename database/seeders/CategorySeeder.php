<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Posts related to technology and innovation.',
            ],
            [
                'name' => 'Lifestyle',
                'description' => 'Posts about lifestyle, health, and wellness.',
            ],
            [
                'name' => 'Travel',
                'description' => 'Posts about travel destinations and experiences.',
            ],
            [
                'name' => 'Food',
                'description' => 'Posts about food, recipes, and culinary experiences.',
            ],
            [
                'name' => 'Health',
                'description' => 'Posts about health, fitness, and well-being.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
