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
        $restaurant1 = Restaurant::where('name', "Pizzeria Alberto's")->first();
        $restaurant2 = Restaurant::where('name', "Salchipapa de l'esquina")->first();

        $foodtype1 = Foodtype::where('name', 'Italiana')->first();
        $foodtype2 = Foodtype::where('name', 'Japonesa')->first();
        $foodtype3 = Foodtype::where('name', 'Kebab')->first();
        $foodtype4 = Foodtype::where('name', 'Vegano')->first();

        $restaurant1->foodtypes()->attach([$foodtype1->id, $foodtype2->id]);
        $restaurant2->foodtypes()->attach([$foodtype3->id, $foodtype4->id]);
    }
}
