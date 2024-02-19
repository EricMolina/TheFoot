<?php

namespace Database\Seeders;
use App\Models\Restaurant;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::where('name', "jorge.alcalde")->first();
        $user2 = User::where('name', "pepe.viyuela")->first();

        Restaurant::create([
            'name' => "Pizzeria Alberto's",
            'description' => "Pizzeria italiana con clases de PHP",
            'location' => "Bellvitge, L'Hospitalet de Llobregat, Barcelona",
            'average_price' => 175,
            'status' => 1,
            'manager_id' => $user1->id
        ]);

        Restaurant::create([
            'name' => "Salchipapa de l'esquina",
            'description' => "Les mejores papes con salchiches de tota barça",
            'location' => "El Raval, Barcelona",
            'average_price' => 12,
            'status' => 1,
            'manager_id' => $user2->id
        ]);
    }
}
