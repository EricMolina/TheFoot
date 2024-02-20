<?php

namespace App\Http\Controllers;
use App\Models\Foodtype;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodtypeController extends Controller
{
    public function list() {
        return Foodtype::all();
    }
}
