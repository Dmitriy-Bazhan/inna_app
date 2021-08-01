<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminListenMessage;
use App\Events\ChatMessage;
use App\Http\Controllers\Controller;
use App\Models\ChatComment;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $data['page'] = 'Chat';

        $comments = ChatComment::with('user')->select('user_id', 'status')->orderBy('status', 'desc')->orderByDesc('created_at')->get()->unique('user_id');
        $data['comments'] = $comments;
        return view('admin.chat.chat', $data);
    }

    public function broadcast(Request $request)
    {
        if (!$request->filled('message') || !$request->filled('user_id')) {
            return response()->json([
                'message' => 'No message to send'
            ], 422);
        }
        $adminId = null;
        if ($request->filled('admin_id')) {
            $adminId = $request->input('admin_id');
        }


        ChatComment::create([
            'user_id' => (int)$request->input('user_id'),
            'is_user_admin' => $adminId,
            'message' => $request->input('message'),
        ]);

        broadcast(new ChatMessage($request->input('message'), $request->input('user_id'), 'Admin'))->toOthers();

        return response()->json([], 200);

    }

    public function addMessagesToModalChat(Request $request)
    {
        if (!$request->filled('user_id')) {
            return response()->json([
                'message' => 'No user_id to send'
            ], 422);
        }

        $comments = ChatComment::with('user')->where('user_id', $request->input('user_id'))->select('message', 'user_id', 'is_user_admin')->get()->toArray();

        return response()->json([
            'response' => $comments
        ], 200);
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

    public function completeChat(Request $request)
    {
        if (!$request->filled('user_id')) {
            return response()->json([
                'message' => 'No user_id to send'
            ], 422);
        }

        ChatComment::where('user_id', $request->input('user_id'))->update(['status' => 'answered']);

        return response()->json([
            'response' => $request->input('user_id')
        ], 200);
    }

    public function addRowToChatsList(Request $request)
    {

        $data['user'] = User::where('id', $request->input('user_id'))->select('id', 'name')->first();

        return response()->json([
            'response' => view('admin.components.chat-row', $data)->render()
        ], 200);
    }

    //VUE EXAMPLE
    public function getComments(Request $request, $user_id = null)
    {
        if (!is_null($user_id)) {
            $comments = ChatComment::where('user_id', $user_id)->orderByDesc('created_at')->get()->toArray();
        } else {
            $comments = ChatComment::all()->toArray();
        }

        return response()->json([
            'comments' => $comments
        ], 200);
    }

}
