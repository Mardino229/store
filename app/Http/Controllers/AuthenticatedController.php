<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedController extends Controller
{
    function register() {
        return view('register');
    }

    function create(Request $request) {
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Registration Successful!');

    }

    function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
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
