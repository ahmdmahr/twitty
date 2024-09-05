<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $posts = $user->posts()->paginate(5);

        return view('users.show',compact('user','posts'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);

        $posts = $user->posts()->paginate(5);
        return view('users.edit',compact('user','posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,User $user)
    {
        
        $validated = $request->validated();
        if($request->has('image')){
            $imagePath = $request->file('image')->store('profile','public');

            $validated['image'] = $imagePath;

            if($user->image && Storage::disk('public')->exists($user->image))
               Storage::disk('public')->delete($user->image);
        }
        $user->update($validated);
        return redirect()->route('profile');
    }

    public function profile(){
        $usr = auth()->user();
        return $this->show($usr);
    }

}

