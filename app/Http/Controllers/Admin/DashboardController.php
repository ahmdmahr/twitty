<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(){
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $totalComments = Comment::count();

        return view('admin.dashboard',compact('totalUsers','totalPosts','totalComments'));
    }
}
