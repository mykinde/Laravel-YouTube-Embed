<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // adjust namespace if different

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology'],
            ['name' => 'Education'],
            ['name' => 'Business'],
            ['name' => 'Entertainment'],
            ['name' => 'Health'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}




