<?php

namespace Database\Seeders;
use App\Models\Foodtype;
use App\Models\Restaurant;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantFoodtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = Restaurant::all();

        foreach ($restaurants as $restaurant) {

            $food1 = Foodtype::find(rand(1, 10));
            $food2 = Foodtype::find(rand(1, 10));

            $restaurant->foodtypes()->attach([$food1->id, $food2->id]);

        }
    }
}
