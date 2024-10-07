<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //all users
    public function index(){
        $users = User::all();
        return response()->json($users);

    }

    // single user
    public function show($id){
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // create a new user
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',

        ]);
    }
        

  
    

    
}
