<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class RestaurantController extends Controller
{
    public function list(Request $request) {
        $restaurants_query = Restaurant::withAvg('valorations', 'score')
            ->with('foodtypes')
            ->withCount('valorations');
        
        // Filters
        if ($request->has('name')) {
            $name = $request->name;
            $restaurants_query->where('name', 'like', "%$name%");
        }

        if ($request->has('min_price') && $request->filled('min_price')) {
            $min_price = $request->min_price;
            $restaurants_query->where('average_price', '>=', $min_price);
        }

        if ($request->has('max_price') && $request->filled('max_price')) {
            $max_price = $request->max_price;
            $restaurants_query->where('average_price', '<=', $max_price);
        }

        if ($request->has('valoration') && $request->filled('valoration')) {
            $valoration = $request->valoration;
            $restaurants_query->having('valorations_avg_score', '>=', $valoration);
        }

        if ($request->has('food_types') && $request->filled('food_types')) {
            $food_types = explode(',', $request->food_types);
            $restaurants_query->whereHas('foodtypes', function ($query) use ($food_types) {
                $query->whereIn('foodtypes.id', $food_types);
            });
        }
        
        // Order by 
        if ($request->has('sort')) {

            $sort_type = $request->has('sort_order') && $request->sort_order == 'DESC' ? 'desc' : 'asc';

            if ($request->sort == 'average_price') {
                $restaurants_query->orderBy('average_price', $sort_type);
            } else if ($request->sort == 'valoration') {
                $restaurants_query->orderBy('valorations_avg_score', $sort_type);
            }
        }

        $restaurants_query->where('status', 1);

        $restaurants = $restaurants_query->get();

        return $restaurants;
    }


    public function show($id) {
        $restaurant = Restaurant::withAvg('valorations', 'score')
            ->with('valorations')
            ->with('foodtypes')
            ->find($id);

        return $restaurant;
    }
}
