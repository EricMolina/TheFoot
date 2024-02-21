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

        $italiana = Foodtype::where('name', 'Italiana')->first();
        $japonesa = Foodtype::where('name', 'Japonesa')->first();
        $kebab = Foodtype::where('name', 'Kebab')->first();
        $vegana = Foodtype::where('name', 'Vegana')->first();
        $griega = Foodtype::where('name', 'Griega')->first();
        $china = Foodtype::where('name', 'China')->first();
        $turca = Foodtype::where('name', 'Turca')->first();
        $colombiana = Foodtype::where('name', 'Colombiana')->first();
        $venezolana = Foodtype::where('name', 'Venezolana')->first();
        $tailandesa = Foodtype::where('name', 'Tailandesa')->first();

        $restaurant1->foodtypes()->attach([$italiana->id, $japonesa->id]);
        $restaurant2->foodtypes()->attach([$kebab->id, $vegana->id]);
    }
}
