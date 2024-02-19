<?php

namespace App\Http\Controllers;
use App\Models\Valoration;
use App\Models\User;
use App\Models\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ValorationController extends Controller
{
    public function store(Request $request) {
        $valoration = new Valoration;

        $user = User::find($request->user);
        $restaurant = Restaurant::find($request->restaurant);

        $valoration->user_id = $user->id;
        $valoration->restaurant_id = $restaurant->id;
        $valoration->score = $request->score;
        $valoration->comment = $request->comment;
        $valoration->save();

        return 'creado papi';
    }
}
