<?php

namespace App\Http\Controllers;

use App\Events\AdminListenMessage;
use Illuminate\Http\Request;
use App\Events\ChatMessage;

class MessageController extends Controller
{
    public function broadcast(Request $request)
    {
        if (!$request->filled('message')) {
            return response()->json([
                'message' => 'No message to send'
            ], 422);
        }

        broadcast(new AdminListenMessage($request->input('user_id'), $request->input('message'), $request->input('username')));
        broadcast(new ChatMessage($request->input('message'), $request->input('user_id'), $request->input('username')))->toOthers();

        return response()->json([], 200);

    }
}
