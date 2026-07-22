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
        $categories = ['Raw material', 'Finish goods', 'Spares', 'Machines', 'others'];
        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}
