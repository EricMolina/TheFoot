<?php

namespace Database\Seeders;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Valoration;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ValorationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurant1 = Restaurant::where('name', "Pizzeria Alberto's")->first();
        $restaurant2 = Restaurant::where('name', "Catalunya Pita House")->first();

        $user1 = User::where('name', "eric.molina")->first();
        $user2 = User::where('name', "jorge.alcalde")->first();

        Valoration::create([
            'score' => 5,
            'comment' => "Buen servisio grasias",
            'restaurant_id' => $restaurant1->id,
            'user_id' => $user1->id,
        ]);

        Valoration::create([
            'score' => 3,
            'comment' => "No me gustó la comida, olia a pies. Uhhhg!",
            'restaurant_id' => $restaurant2->id,
            'user_id' => $user2->id,
        ]);

        Valoration::create([
            'score' => 5,
            'comment' => "No está nada mal!",
            'restaurant_id' => $restaurant2->id,
            'user_id' => $user2->id,
        ]);
    }
}
