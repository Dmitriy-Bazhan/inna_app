<?php

namespace App\Http\Controllers;

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

//        ChatMessage::dispatch($request->input('message'));

        broadcast(new ChatMessage($request->input('message')))->toOthers();

        return response()->json([], 200);

    }
}
