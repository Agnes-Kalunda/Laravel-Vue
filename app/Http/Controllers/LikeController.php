<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // List all likes for a post
    public function index($postId)
    {
        $likes = Like::where('post_id', $postId)->with('user')->get();
        return response()->json($likes);
    }

    // Like a post
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        $like = Like::create($request->all());
        return response()->json($like, 201);
    }

    // Unlike a post
    public function destroy($id)
    {
        Like::destroy($id);
        return response()->json(null, 204);
    }
}
