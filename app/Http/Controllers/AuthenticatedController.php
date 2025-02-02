<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedController extends Controller
{
    function register() {
        return view('register');
    }

    function create(RegisterRequest $request) {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Registration Successful!');

    }

    function login(LoginRequest $request) {

        $credentials = $request->only('email', 'password');
        if (Auth::guard()->attempt($credentials)){
            return redirect()->intended('/home');
        }

        return back()->with('err', 'Invalid Credentials');
    }

    function loginView() {
        return view('login');
    }

    function logout() {
        Auth::logout();
        return redirect('/')->with('success', 'You have been logged out');
    }
}
