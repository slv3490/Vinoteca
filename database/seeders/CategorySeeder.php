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
        Category::create([
            "name" => "Vino Tinto",
            "slug" => "vino-tinto",
            "description" => "Vino tinto de excelente calidad con aromas citricos y acidos",
            "image" => "vino tinto-1728683427.jpeg"
        ]);
        Category::create([
            "name" => "Vino Valentin",
            "slug" => "vino-valentin",
            "description" => "Vino valentin de excelente calidad con aromas citricos y acidos",
            "image" => "valentin vino-1728682167.jpg"
        ]);
        Category::create([
            "name" => "Vino Tinto Añejado",
            "slug" => "vino-tinto-añejado",
            "description" => "Vino tinto de excelente calidad con aromas citricos y acidos",
            "image" => "valentin vino-1728682167.jpg"
        ]);
    }
}
