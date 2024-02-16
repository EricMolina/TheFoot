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
            'name' => "eric.molina",
            'email' => "eric.molina@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Client",
        ]);

        User::create([
            'name' => "jorge.alcalde",
            'email' => "jorge.alcalde@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Manager",
        ]);

        User::create([
            'name' => "pepe.viyuela",
            'email' => "pepe.viyuela@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Manager",
        ]);

        User::create([
            'name' => "ricard.casals",
            'email' => "ricard.casals@gmail.com",
            'password' => Hash::make('asdASD123'),
            'role' => "Administrator",
        ]);
    }
}
