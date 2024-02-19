<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Valoration;
use App\Models\RestaurantImage;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        try {
            DB::beginTransaction();

            $restaurant = new Restaurant;

            // Store the thumbnail
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('images/thumbnails'), $thumbnail_name);
    
            $manager = User::find($request->manager_id);
    
            // Create the restaurant
            $restaurant->name = $request->name;
            $restaurant->description = $request->description;
            $restaurant->location = $request->location;
            $restaurant->average_price = $request->average_price;
            $restaurant->status = $request->status;
            $restaurant->manager_id = $manager->id;
            $restaurant->thumbnail = $thumbnail_name;
            $restaurant->save();
    
            // Store the restaurant images
            $images = $request->file('images');
            foreach ($images as $image) {
                $rand = substr(uniqid('', true), -5);
                $images_name = $rand . "_" . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/restaurants'), $images_name);
    
                $restaurant_image = new RestaurantImage;
                $restaurant_image->restaurant_id = $restaurant->id;
                $restaurant_image->image_url = $images_name;
                $restaurant_image->save();
            }

            // Create the restaurant foodtypes
            $foodtypes = $request->foodtypes;
            foreach ($foodtypes as $foodtype) {
                $restaurant->foodtypes()->attach($foodtype);
            }

            DB::commit();
    
            return "creado papi";

        } catch (Exception $e) {
            DB::rollBack();
            return "error";
        }

    }

    public function update($id, Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'location' => 'required|max:255',
            'average_price' => 'required|integer',
            'status' => 'required|integer',
            'manager_id' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            $restaurant = Restaurant::find($id);

            $manager = User::find($request->manager_id);

            // Update restaurant
            $restaurant->name = $request->name;
            $restaurant->description = $request->description;
            $restaurant->location = $request->location;
            $restaurant->average_price = $request->average_price;
            $restaurant->status = $request->status;
            $restaurant->manager_id = $manager->id;

            // Update restaurant thumbnail
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = time() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('images/thumbnails'), $thumbnail_name);
                $restaurant->thumbnail = $thumbnail_name;
            }

            $restaurant->save();

            // Update the restaurant foodtypes
            $restaurant->foodtypes()->detach();
            $foodtypes = $request->foodtypes;
            foreach ($foodtypes as $foodtype) {
                $restaurant->foodtypes()->attach($foodtype);
            }

            DB::commit();
    
            return "modificado";

        } catch (Exception $e) {
            DB::rollBack();
            return "error";
        }
    }


    public function destroy($id) {
        try {
            DB::beginTransaction();
            
            // Delete restaurant valorations
            $valorations = Valoration::where('restaurant_id', $id);
            $valorations->delete();

            // Delete restaurant images
            $restaurant_images = RestaurantImage::where('restaurant_id', $id);
            $restaurant_images->delete();

            $restaurant = Restaurant::find($id);
            // Delete restaurant foodtypes
            $restaurant->foodtypes()->detach();
            // Delete restaurant
            $restaurant->delete();

            DB::commit();

            return "eliminado";

        } catch (Exception $e) {
            DB::rollBack();
            return "error";
        }

    }

    
    public function formejemplo($id) {
        $restaurant = Restaurant::find($id);

        return view('formejemplo', compact('restaurant'));
    }
}
