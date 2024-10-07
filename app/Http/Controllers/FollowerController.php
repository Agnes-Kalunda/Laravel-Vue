<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    // follower list
    public function index($userId)
    {
        $followers = Follower::where('user_id', $userId)->with('follower')->get();
        return response()->json($followers);
    }

    // Followuser
    public function store(Request $request)
    {
        $request->validate([
            'follower_id' => 'required|exists:users,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $follower = Follower::create($request->all());
        return response()->json($follower, 201);
    }

    // Unfollow user
    public function destroy($id)
    {
        Follower::destroy($id);
        return response()->json(null, 204);
    }
}
