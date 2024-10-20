<?php

namespace Database\Seeders;

use App\Models\Wine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wine::create([
            "name" => "Vino tinto prueba1",
            "slug" => "vino-tinto-prueba2",
            "description" => "Vino de excelencia",
            "year" => "1995",
            "price" => 200,
            "stock" => 20,
            "image" => "imagen.jpg",
            "category_id" => 1
        ]);
        Wine::create([
            "name" => "Vino tinto prueba2",
            "slug" => "vino-tinto-prueba2",
            "description" => "Vino de excelencia",
            "year" => "2000",
            "price" => 100,
            "stock" => 40,
            "image" => "imagen.jpg",
            "category_id" => 2
        ]);
        Wine::create([
            "name" => "Vino tinto prueba3",
            "slug" => "vino-tinto-prueba3",
            "description" => "Vino de excelencia",
            "year" => "1980",
            "price" => 400,
            "stock" => 5,
            "image" => "imagen.jpg",
            "category_id" => 3
        ]);
    }
}
