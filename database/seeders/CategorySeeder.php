<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //defining default categories
    public function run(): void
    {
        $categorias = ['Homem', 'Mulher', 'Unissex'];
        foreach($categorias as $nome){
            Category::firstOrCreate(['name' => $nome]);
        }
    }
}
