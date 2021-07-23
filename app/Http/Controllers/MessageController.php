<?php

namespace App\Http\Controllers;

use App\Events\AdminListenMessage;
use Illuminate\Http\Request;
use App\Events\ChatMessage;
use App\Models\ChatComment;

class MessageController extends Controller
{
    public function broadcast(Request $request)
    {
        if (!$request->filled('message') || !$request->filled('user_id')) {
            return response()->json([
                'message' => 'No message to send'
            ], 422);
        }

        ChatComment::create([
            'user_id' => (int)$request->input('user_id'),
            'message' => $request->input('message'),
        ]);


        broadcast(new AdminListenMessage($request->input('user_id'), $request->input('message'), $request->input('username')));
        broadcast(new ChatMessage($request->input('message'), $request->input('user_id'), $request->input('username')))->toOthers();

        return response()->json([], 200);

    }
}
