<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatComment;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $data['page'] = 'Chat';

        $comments = ChatComment::with('user')->select('user_id','status')->orderBy('status', 'desc')->orderByDesc('created_at')->get()->unique('user_id');
//        dd($comments);


        $data['comments'] = $comments;
        return view('admin.chat.chat', $data);
    }

    public function checkHasNewMessage()
    {

        $checkHasNewComment = ChatComment::where('status', 'not_answered')->select('id')->first();

        if (!is_null($checkHasNewComment)) {
            $answer = 'has';
        } else {
            $answer = 'not_has';
        }

        return response()->json([
            'response' => $answer
        ], 200);
    }

    public function completeChat(Request $request){

    }
}
