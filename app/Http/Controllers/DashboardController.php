<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        
        // $posts = Post::withCount('likedByUsers')->orderBy('created_at','DESC');

        // if(request()->has('search')){
        //     $posts = $posts->Search(request('search'));
        // }

        $posts = Post::when(request()->has('search'),function($query){
            $query->Search(request('search'));
        })->orderBy('created_at','DESC');

        return view('dashboard',[
            'posts'=>$posts->paginate(5)
        ]);
    }
    
}
