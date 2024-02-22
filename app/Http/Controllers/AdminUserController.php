<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Mail\RestaurantChanged;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:Client,Manager,Administrator',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profiles'), $imageName);
            $data['profile_image'] = $imageName;
        }
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return "ok";
    }

    public function list()
    {
        return User::all();
    }

    public function show(Request $request)
    {
        return User::find($request->id);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:Client,Manager,Administrator',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($request->file('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profiles'), $imageName);
            $data['profile_image'] = $imageName;

            // Check if user already had a profile image
            if ($user->profile_image) {
                // Delete the previous profile image from the server
                $previousImagePath = public_path('images/profiles') . '/' . $user->profile_image;
                if (File::exists($previousImagePath)) {
                    File::delete($previousImagePath);
                }
            }
        } else {
            unset($data['profile_image']);
        }

        if ($request->password) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);

        // Get the restaurants from the request
        $updatedRestaurant = $request->updatedRestaurant;
        $oldRestaurant = $request->oldRestaurant;
        Mail::to('maxylandbuzon@gmail.com')->send(new RestaurantChanged($updatedRestaurant, $oldRestaurant));
        
        return "ok";
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);

        if ($user->role == "Manager") {
            Restaurant::where('manager_id', $user->id)->update(['manager_id' => null]);
        }
        if ($user->profile_image) {
            $previousImagePath = public_path('images/profiles') . '/' . $user->profile_image;
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $user->delete();
        return "ok";
    }

    public function managers()
    {
        return User::where('role', 'Manager')->get();
    }
}