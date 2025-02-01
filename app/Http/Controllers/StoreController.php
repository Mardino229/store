<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    function home(){
        return view('welcome');
    }
    function store(Request $request){
        $request->validate([
            'name' => 'required|min:3',
        ]);

        Store::create([
            "name" => $request->name,
            "user_id"=>Auth::user()->id,
        ]);

        return redirect()->back()->with('success','Store added successfully');
    }
}
