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

        Restaurant::create([
            'name' => "El Gato Negro",
            'description' => "Cocina catalana moderna en un ambiente acogedor",
            'location' => "Gràcia, Barcelona",
            'average_price' => 30,
            'status' => 1,
            'manager_id' => $user1->id
        ]);
        
        Restaurant::create([
            'name' => "La Mar Salada",
            'description' => "Mariscos frescos y vistas al mar",
            'location' => "Barceloneta, Barcelona",
            'average_price' => 40,
            'status' => 1,
            'manager_id' => $user2->id
        ]);
        
        Restaurant::create([
            'name' => "Bacoa Universitat",
            'description' => "Hamburguesas gourmet en un ambiente relajado",
            'location' => "Eixample, Barcelona",
            'average_price' => 15,
            'status' => 1,
            'manager_id' => $user1->id
        ]);
        
        Restaurant::create([
            'name' => "El Celler de Can Roca",
            'description' => "Cocina catalana de vanguardia en un espacio elegante",
            'location' => "Sant Gervasi, Barcelona",
            'average_price' => 80,
            'status' => 1,
            'manager_id' => $user2->id
        ]);
        
        Restaurant::create([
            'name' => "La Piazzetta",
            'description' => "Auténtica pizza italiana en un ambiente familiar",
            'location' => "Sants, Barcelona",
            'average_price' => 20,
            'status' => 1,
            'manager_id' => $user1->id
        ]);
        
        Restaurant::create([
            'name' => "El Asador de Aranda",
            'description' => "Cocina castellana tradicional en un espacio rústico",
            'location' => "Les Corts, Barcelona",
            'average_price' => 35,
            'status' => 1,
            'manager_id' => $user2->id
        ]);
        
        Restaurant::create([
            'name' => "La Vinoteca Torres",
            'description' => "Tapas y vinos en un ambiente sofisticado",
            'location' => "Poble Sec, Barcelona",
            'average_price' => 30,
            'status' => 1,
            'manager_id' => $user1->id
        ]);
        
        Restaurant::create([
            'name' => "El Jardín de la Abuela",
            'description' => "Cocina casera en un ambiente acogedor",
            'location' => "Sarrià, Barcelona",
            'average_price' => 25,
            'status' => 1,
            'manager_id' => $user2->id
        ]);
        
        Restaurant::create([
            'name' => "La Bodega del Mar",
            'description' => "Mariscos frescos y paella en un ambiente marinero",
            'location' => "Barceloneta, Barcelona",
            'average_price' => 40,
            'status' => 1,
            'manager_id' => $user1->id
        ]);
        
        Restaurant::create([
            'name' => "El Patio Andaluz",
            'description' => "Cocina andaluza y flamenco en vivo",
            'location' => "Eixample, Barcelona",
            'average_price' => 30,
            'status' => 1,
            'manager_id' => $user2->id
        ]);
        
        Restaurant::create([
            'name' => "La Taberna del Cura",
            'description' => "Tapas y vinos en un ambiente rústico. El menú infantil se paga con servicios. Local acogedor para los más pequeños de la familia.",
            'location' => "Gràcia, Barcelona",
            'average_price' => 20,
            'status' => 1,
            'manager_id' => $user1->id
        ]);
        
        Restaurant::create([
            'name' => "El Balcón de Picasso",
            'description' => "Cocina mediterránea con vistas al Museo Picasso",
            'location' => "El Born, Barcelona",
            'average_price' => 35,
            'status' => 1,
            'manager_id' => $user2->id
        ]);
    }
}
