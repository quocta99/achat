<?php

namespace App\Http\Controllers;

use App\Facade\Chat;
use App\Http\Requests\CreateConversation;
use App\Http\Requests\SendMessage;
use App\Models\Conversation;
use App\Models\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            ->where(function($q) {
                $q
                ->where('name', 'like', "%" . request('keyword', '') . '%')
                ->orWhere('email', 'like', "%" . request('keyword', '') . '%');
            })
            ->where('id', '!=', auth()->id())
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
        $conversation = Chat::conversation($conversation)->getConversation();

        return response()->json([
            'data' => $conversation ? ($conversation->lastMessage ? $conversation : null) : null
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

    /**
     * Create conversation function
     *
     * @return void
     */
    public function createConversation(CreateConversation $request)
    {
        $conversation = Chat::createConversation($request->participants ?: [], $request->setting ?: [])
            ->getConversation();

        return response()->json([
            "data" => $conversation
        ]);
    }

    /**
     * Send message function
     *
     * @return void
     */
    public function sendMessage(SendMessage $request, Conversation $conversation)
    {
        if($request->file('file')) {
            $file = $request->file('file');

            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('chat/' . auth()->id() . '/images', $fileName);

            $request->merge([
                'type' => 'image',
                'attachment' => [
                    'image' => [
                        'name' => $file->getClientOriginalName(),
                        'extension' => $file->getClientOriginalExtension(),
                        'real_path' => $file->getRealPath(),
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType(),
                        'path' => '/chat/' . auth()->id() . '/images/' . $fileName
                    ]
                ]
            ]);
        }

        $message = Chat::conversation($conversation)
            ->send($request->message, $request->type ?: 'text', $request->attachment ?: [], $request->parent);

        return response()->json([
            "data" => $message
        ]);
    }

    /**
     * Read message function
     *
     * @param Conversation $conversation
     * @param Message $message
     * @return void
     */
    public function readMessage(Conversation $conversation)
    {
        $message = Message::select('messages.id')
            ->whereConversationId($conversation->id)
            ->leftJoin('readed_messages', 'messages.id', '=', DB::raw('readed_messages.message_id AND readed_messages.user_id = ' . Auth::id()))
            ->whereNull('readed_messages.user_id')
            ->get()
            ->pluck('id')
            ->toArray() ?? [];

        Chat::readMessage($message, request('user_id'));

        return response()->json([
            "message" => "Readed message successfully!"
        ]);
    }
}
