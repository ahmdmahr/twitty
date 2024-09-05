<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(){

        $posts = Post::latest()->paginate(5);

        return view('admin.posts.index',compact('posts'));
        
    }
}
