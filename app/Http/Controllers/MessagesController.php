<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Auth;

class MessagesController extends Controller
{


    public function store(Request $request){

        $message = Message::create([
            'message' => $request->get('message'),
            'from_user_id' =>  Auth::user()->id,
            'to_user_id' => $request->get('to_user_id'),

        ]);
//        $comments = Post::find($post_id)->comment;
//        $users = auth()->user()->following()->pluck('profiles.user_id');
//        $posts = Post::whereIn('user_id', $users)->latest()->get();
        //dd($comments);

//        return view('posts.index', compact('comments', 'posts'));
        return response()->json(['success' => true]);
    }

public function getMessages(Request $request){
    //$messages=$request->all();
//    $messages = Message::where('to_user_id', $request->get('to'))
//        ->where('to_user_id',Auth::user()->id)->get();
   // dd($messages);
    $messages = Message::leftjoin('profiles','profiles.user_id','=','messages.from_user_id')
        ->leftjoin('users','users.id','=','messages.from_user_id')
        ->where([
    ['from_user_id', '=',Auth::user()->id],
            ['to_user_id', '=', $request->get('to')]
])
        ->orwhere([
            ['from_user_id', '=', $request->get('to')],
            ['to_user_id', '=', Auth::user()->id]
])->orderby('created_at','ASC')->select(['messages.*','profiles.image','users.username'])
        ->get();

    return response()->json(['success' => true, 'messages' => $messages]);
}


}
