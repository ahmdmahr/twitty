<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function store(){
        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8'
            ]
        );
        $user = User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password'])
            ]
        );
        
        Mail::to($user->email)
        ->send(new WelcomeEmail($user));

        return redirect()->route('dashboard')->with('success','Account created successfully!');
    }

    public function login(){
        return view('auth.login');
    }
    public function authenticate(){
        // dd(request()->all());
        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]
        );

        if(auth()->attempt($validated)){
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Logged in successfully!');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Incorrect email or password'
        ]);
    }

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success','Logged out successfully!');
    }

}
