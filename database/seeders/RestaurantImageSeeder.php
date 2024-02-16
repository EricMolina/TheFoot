<?php

namespace Database\Seeders;
use App\Models\Restaurant;
use App\Models\RestaurantImage;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurant1 = Restaurant::where('name', "Pizzeria Alberto's")->first();
        $restaurant2 = Restaurant::where('name', "Salchipapa de l'esquina")->first();

        RestaurantImage::create([
            'restaurant_id' => $restaurant1->id,
            'image_url' => ''
        ]);

        RestaurantImage::create([
            'restaurant_id' => $restaurant1->id,
            'image_url' => ''
        ]);

        RestaurantImage::create([
            'restaurant_id' => $restaurant2->id,
            'image_url' => ''
        ]);

        RestaurantImage::create([
            'restaurant_id' => $restaurant2->id,
            'image_url' => ''
        ]);
    }
}
