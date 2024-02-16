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
            'name' => "Italiana"
        ]);

        Foodtype::create([
            'name' => "Japonesa"
        ]);

        Foodtype::create([
            'name' => "Kebab"
        ]);

        Foodtype::create([
            'name' => "Vegano"
        ]);
    }
}
