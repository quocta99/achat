<?php

namespace App\Http\Controllers;

use App\Facade\Chat;
use App\Models\Conversation;
use App\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index function
     *
     * @return void
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * Get users function
     *
     * @return void
     */
    public function getUsers()
    {
        $users = app(User::class)
            ->where('name', 'like', "%" . request('keyword', '') . '%')
            ->orWhere('email', 'like', "%" . request('keyword', '') . '%')
            ->take(20)
            ->get();

        return response()->json([
            'data' => $users
        ]);
    }

    /**
     * Get conversations function
     *
     * @return void
     */
    public function getConversations()
    {
        $conversations = Chat::getConversations(request('last_conversation_id', null));

        return response()->json([
            'data' => $conversations
        ]);
    }

    /**
     * Get conversation detail function
     *
     * @param Conversation $conversation
     * @return void
     */
    public function getConversationDetail(Conversation $conversation)
    {
        return response()->json([
            'data' => Chat::conversation($conversation)->getConversation()
        ]);
    }

    /**
     * Get messages function
     *
     * @param Conversation $conversation
     * @return void
     */
    public function getMessages(Conversation $conversation)
    {
        $messages = Chat::conversation($conversation)
            ->getMessages(request('last_message_id', null));

        return response()->json([
            'data' => $messages
        ]);
    }
}
