<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function like(Post $post){

        $liker = auth()->user();

        $liker->likedPosts()->attach($post);

        return redirect(route('dashboard'))->with('success','Liked successfully');

    }

    public function unlike(Post $post){
        $liker = auth()->user();

        $liker->likedPosts()->detach($post);

        return redirect(route('dashboard'))->with('success','liked successfully');
    }
}
