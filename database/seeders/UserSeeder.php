<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        User::create([
            'name' => "Ricard Casals",
            'email' => "rcasals@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Administrator",
            'profile_image' => 'rcasals.png',
        ]);

        User::create([
            'name' => "Pedro Sánchez",
            'email' => "psanchez@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Administrator",
            'profile_image' => 'psanchez.png',
        ]);


        User::create([
            'name' => "Jorge Alcalde",
            'email' => "jalcalde@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Manager",
            'profile_image' => 'jalcalde.png',
        ]);

        User::create([
            'name' => "Pepe Viyuela",
            'email' => "pviyuela@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Manager",
            'profile_image' => 'pviyuela.png',
        ]);

        User::create([
            'name' => "Alberto De Santos",
            'email' => "adesantos@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Manager",
            'profile_image' => 'adesantos.png',
        ]);
        
        
        User::create([
            'name' => "Eric Molina",
            'email' => "emolina@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
            'profile_image' => 'emolina.png',
        ]);
        
        User::create([
            'name' => "Ruth García",
            'email' => "rgarcia@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
            'profile_image' => 'rgarcia.png',
        ]);

        User::create([
            'name' => "Juan Martínez",
            'email' => "jmartinez@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
            'profile_image' => 'jmartinez.png',
        ]);

        User::create([
            'name' => "Juan Pérez",
            'email' => "jperez@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
            'profile_image' => 'jperez.png',
        ]);

        User::create([
            'name' => "Ana García",
            'email' => "agarcia@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
            'profile_image' => 'agarcia.png',
        ]);

        User::create([
            'name' => "Carlos Martínez",
            'email' => "cmartinez@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
            'profile_image' => 'cmartinez.png',
        ]);

        User::create([
            'name' => "Manel García",
            'email' => "mgarcia@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
            'profile_image' => 'mgarcia.png',
        ]);

        User::create([
            'name' => "Laura López",
            'email' => "llopez@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
            'profile_image' => 'llopez.png',
        ]);

        User::create([
            'name' => "Mariano Rajoy",
            'email' => "mrajoy@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
            'profile_image' => 'mrajoy.png',
        ]);

        User::create([
            'name' => "Pablo Motos",
            'email' => "pmotos@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
            'profile_image' => 'pmotos.png',
        ]);
    }
}
