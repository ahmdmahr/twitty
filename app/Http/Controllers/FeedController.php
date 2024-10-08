<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        // The pluck method is used to retrieve an array of values for a given column (user_id)
        $followingsIDs = auth()->user()->followings()->pluck('user_id');


        $posts = Post::whereIn('user_id',$followingsIDs)->latest();

        if(request()->has('search')){
            $posts = $posts->Search(request('search'));
        }

        return view('dashboard',[
            'posts'=>$posts->paginate(5)
        ]);
    }
}
