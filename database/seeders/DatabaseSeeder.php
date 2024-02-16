<?php

namespace Database\Seeders;
use Database\Seeders\UserSeeder;
use Database\Seeders\RestaurantSeeder;
use Database\Seeders\FoodtypeSeeder;
use Database\Seeders\RestaurantFoodtypeSeeder;
use Database\Seeders\RestaurantImageSeeder;
use Database\Seeders\ValorationSeeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->Call(UserSeeder::class);
        $this->Call(RestaurantSeeder::class);
        $this->Call(FoodtypeSeeder::class);
        $this->Call(RestaurantFoodtypeSeeder::class);
        $this->Call(RestaurantImageSeeder::class);
        $this->Call(ValorationSeeder::class);
    }
}
