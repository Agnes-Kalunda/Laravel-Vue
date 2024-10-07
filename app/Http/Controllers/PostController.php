<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with('user')->get();
        return response()->json($posts);
    }

    // show single post
    public function show($id){
        $post = Post::with('user', 'comments', 'likes')->findOrFail($id);
        return response()->json($post);
    }


    // create new post
    public function store(Request $request){
        $request->validate([
            'title'=>'required|string|max:225',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    // post update

    public function update(Request $request, $id){
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post, 200);
    }


    // delete post
    public function destroy($id){
        post::destroy($id);
        return response()->json(null, 204);
    }
}
