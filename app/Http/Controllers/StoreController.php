<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    function home(){
        return view('welcome');
    }
    function store(Request $request){
        $request->validate([
            'name' => 'required|min:3|regex:/^\S*$/',
        ]);

        Store::create([
            "name" => $request->name,
            "user_id"=>Auth::user()->id,
        ]);

        return to_route('list');
    }
    function showShop($store){
        $shop = Store::where('name', $store)->firstOrFail();

        $user = User::find($shop->user_id);
        return view('show', compact('user'));
    }

    function list(){
        $id = Auth::user()->id;
        $shops = Store::where('user_id', $id)->get();
        return view('list', compact('shops'));
    }

//    function see ($name) {
//        $shop = Store::where('name', $name)->firstOrFail();
//        $user = $shop->user;
//        return view('view', compact('user'));
//    }
}
