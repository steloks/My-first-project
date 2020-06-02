<?php

namespace App\Http\Controllers;

use App\ProfileUser;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Auth;

class ProfileController extends Controller
{
    public function index(User $user)
    {

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;


        return view('profiles.home', compact('user', 'follows'));


    }

    public function edit(\App\User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(\App\User $user)
    {
        $this->authorize('update', $user->profile);

        $date = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',

        ]);
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = [
                'image' => $imagePath
            ];
        }

        auth()->user()->profile->update(array_merge(
            $date,
            $imageArray ?? []
        ));
        return redirect("/profile/{$user->id}");
    }
}
