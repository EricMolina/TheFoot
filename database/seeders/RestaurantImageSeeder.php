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
        $restaurants = Restaurant::all();

        foreach ($restaurants as $restaurant) {
            for ($i=1; $i <= 3 ; $i++) { 

                $restaurant_id = $restaurant->id;

                RestaurantImage::create([
                    'restaurant_id' => $restaurant_id,
                    'image_url' => "example$restaurant_id-$i.jpg"
                ]);

            }
        }
    }
}
