<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // List messages between users
    public function index($userId)
    {
        $messages = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with('sender', 'receiver')
            ->get();
        return response()->json($messages);
    }

    // single message
    public function show($id)
    {
        $message = Message::with('sender', 'receiver')->findOrFail($id);
        return response()->json($message);
    }

    // Send message
    public function store(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);

        $message = Message::create($request->all());
        return response()->json($message, 201);
    }

    // Update message
    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->update($request->all());
        return response()->json($message);
    }

    // Deletemessage
    public function destroy($id)
    {
        Message::destroy($id);
        return response()->json(null, 204);
    }
}
