<?php

namespace App\Http\Controllers;
use App\Models\Valoration;
use App\Models\User;
use App\Models\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class ValorationController extends Controller
{
    public function create(Restaurant $restaurant) {
        return view ('restaurantform', compact('restaurant'));
    }
    public function store(Request $request) {
        $request->validate([
            'restaurant_id' => [
                'exists:restaurants,id',
                Rule::unique('valorations')->where(function ($query) {
                    return $query->where('user_id', Auth::user()->id)
                                 ->where('restaurant_id', request('restaurant_id'));
                }),
            ],
            'score' => 'required|integer|between:1,10',
        ]);

        $valoration = new Valoration;
        $restaurant = Restaurant::find($request->restaurant_id);
        $valoration->user_id = Auth::user()->id;
        $valoration->restaurant_id = $restaurant->id;
        $valoration->score = $request->score;
        $valoration->comment = $request->comment;
        $valoration->save();

        if ($valoration->id) {
            return response()->json(['status' => 'ok']);
        } else {
            return response()->json(['status' => 'bad']);
        }
    }
}
