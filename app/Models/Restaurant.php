<?php

namespace App\Models;
use App\Models\Foodtype;
use App\Models\User;
use App\Models\RestaurantImage;
use App\Models\Valoration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function foodtypes() {
        return $this->belongsToMany(Foodtype::class, 
            'restaurants_foodtypes', 'restaurant_id', 'foodtype_id');
    }

    public function manager() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->hasMany(RestaurantImage::class);
    }

    public function valorations() {
        return $this->hasMany(Valoration::class);
    }
}
