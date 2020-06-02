<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{


    public function store(Request $request)
    {
//        sleep(2);
        $toggle = auth()->user()->following()->toggle(User::find($request->get('ass')));
        return json_encode(["success" => true,'message'=>count($toggle['attached'])>0?'Follow successful':'Unfolow successful']);
    }

    public function getFollowers(Request $request){

        $follower=User::where('users.id',$request->get('userID'))->leftjoin('profiles', 'profiles.user_id', '=', 'users.id')
            ->get();



        return response()->json(['success' => true, 'follower' => $follower]);


    }
}
