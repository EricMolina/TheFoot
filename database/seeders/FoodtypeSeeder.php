<?php

namespace Database\Seeders;
use App\Models\Foodtype;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Foodtype::create([
            'name' => "Italiana",
            'icon' => 'italiano.webp'
        ]);

        Foodtype::create([
            'name' => "Japonesa",
            'icon' => 'japones.webp'
        ]);

        Foodtype::create([
            'name' => "Kebab",
            'icon' => 'kebab.webp'
        ]);

        Foodtype::create([
            'name' => "Vegana",
            'icon' => 'vegano.webp'
        ]);

        Foodtype::create([
            'name' => "Griega",
            'icon' => 'griego.webp'
        ]);

        Foodtype::create([
            'name' => "China",
            'icon' => 'china.webp'
        ]);

        Foodtype::create([
            'name' => "Desayuno",
            'icon' => 'desayuno.webp'
        ]);

        Foodtype::create([
            'name' => "Americano",
            'icon' => 'americano.webp'
        ]);

        Foodtype::create([
            'name' => "Venezolana",
            'icon' => 'venezolano.webp'
        ]);

        Foodtype::create([
            'name' => "Tailandesa",
            'icon' => 'thailandes.webp'
        ]);
    }
}
