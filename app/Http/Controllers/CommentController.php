<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request,Post $post){
        // dump(request()->all());
        $validated = $request->validated();
        $validated['post_id'] = $post->id;
        $validated['user_id'] = auth()->id();

        Comment::create($validated);

        return redirect()->route('posts.show',$post->id)->with('success','Comment posted successfully!');
        }
}
