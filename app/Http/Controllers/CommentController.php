<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // all comments
    public function index()
    {
        $comments = Comment::with('user', 'post')->get();
        return response()->json($comments);
    }

    // Show a single comment
    public function show($id)
    {
        $comment = Comment::with('user', 'post')->findOrFail($id);
        return response()->json($comment);
    }

    // new comment
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $comment = Comment::create($request->all());
        return response()->json($comment, 201);
    }

    // Update  comment
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        return response()->json($comment);
    }

    // Delete  comment
    public function destroy($id)
    {
        Comment::destroy($id);
        return response()->json(null, 204);
    }
}
