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

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user , 201);
    }


    // uodate user info
    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user );
    }

    // delete user

    public function destroy($id){
        User::destroy($id);
        return response()->json(null ,204);
    }
        

  
    

    
}
