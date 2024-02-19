<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminRestaurantController extends Controller
{
    public function list() {
        $restaurants = Restaurant::all();

        return $restaurants;
    }

    public function show($id) {
        $restaurant = Restaurant::with('foodtypes')->find($id);

        return $restaurant;
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'location' => 'required|max:255',
            'average_price' => 'required|integer',
            'status' => 'required|integer',
            'manager_id' => 'required|integer',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $restaurant = new Restaurant;

        $image = $request->file('thumbnail');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/thumbnails'), $imageName);

        $manager = User::find($request->manager_id);

        $restaurant->name = $request->name;
        $restaurant->description = $request->description;
        $restaurant->location = $request->location;
        $restaurant->average_price = $request->average_price;
        $restaurant->status = $request->status;
        $restaurant->manager_id = $manager->id;
        $restaurant->thumbnail = $imageName;
        $restaurant->save();

        return "creado papi";
    }

    public function formejemplo() {
        return view("formejemplo");
    }
}
