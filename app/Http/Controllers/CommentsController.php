<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Post;
use Illuminate\Http\Request;
use Auth;

class CommentsController extends Controller
{


    public function store(Request $request)
    {
//        var_dump($request->all());
//        exit();

        $comment = Comments::create([
            'comment' => $request->get('comment'),
            'post_id' => $request->get('post_id'),
            'user_id' => Auth::user()->id,

        ]);
//        $comments = Post::find($post_id)->comment;
//        $users = auth()->user()->following()->pluck('profiles.user_id');
//        $posts = Post::whereIn('user_id', $users)->latest()->get();
        //dd($comments);

//        return view('posts.index', compact('comments', 'posts'));
        $new_comment = Comments::where('comments.id', $comment->id)->leftjoin('users', 'users.id', '=', 'comments.user_id')
            ->leftjoin('profiles', 'profiles.user_id', '=', 'users.id')->first();
        return response()->json(['success' => true, 'new_comment' => $new_comment]);


    }

    public function getComments(Request $request)
    {
        $comments = Comments::where('post_id', $request->get('id'))->leftjoin('users', 'users.id', '=', 'comments.user_id')
            ->leftjoin('profiles', 'profiles.user_id', '=', 'users.id')->select('comments.id', 'comments.comment', 'users.username', 'profiles.image')->get();

        return response()->json(['success' => true, 'comments' => $comments]);
    }

//    public function getUserId(Request $request)
//    {
//        $comments = Comments::where('post_id', $request->get('id'))->leftjoin('users', 'users.id', '=', 'comments.user_id')
//            ->leftjoin('profiles', 'profiles.user_id', '=', 'users.id')->get();
//        return response()->json(['success' => true, 'comments' => $comments]);
//    }


    public function delete(Request $request)
    {
        //sleep(1);
//        var_dump($request->all());
//        exit();

 Comments::where('id',$request->get('commentid'))->delete();
//var_dump($comment_del);
//exit;
return response()->json(['success'=>true]);

    }
}
