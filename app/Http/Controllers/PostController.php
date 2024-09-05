<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    public function show(Post $post){
        
        // laravel will go and search for post in the db for us using compact function
        return view('posts.show',compact('post'));
    }

    public function store(CreatePostRequest $request){

        $validated = $request->validated();

        // dd($validated);

        // $post = new Post([
        //     'content'=>request()->get('post')
        // ]);
        // $post->save();

        $validated['user_id'] = auth()->id();


        POST::create($validated);

        return redirect()->route('dashboard')->with('success','Post was created successfully!');
    }

    public function destroy(Post $post){
        // dump('deleting');

        // Post::where('id',$id)->firstOrFail()->delete();

        // route model binding
       
        $this->authorize('delete',$post);

        $post->delete();

        return redirect()->route('dashboard')->with('success','Post was deleted successfully!');
    }

    public function edit(Post $post){
        $this->authorize('update',$post);
        $editing = true;
        return view('posts.show',compact('post','editing'));
    }

    public function update(UpdatePostRequest $request,Post $post){
        $this->authorize('update',$post);
        
        $validated = $request->validated();

        $post->update($validated);
        
        return redirect()->route('posts.show',$post->id)->with('success','Post was updated successfully!');
        
    }

}
