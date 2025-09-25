<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Grains'],
            ['name' => 'Protein'],
            ['name' => 'Vegetables'],
            ['name' => 'Cassava'],
            ['name' => 'Liquid'],
        ];

        foreach($categories as $category) {
            Category::create($category);
        }
    }
}
