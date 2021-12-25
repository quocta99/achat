<?php 

namespace App\Supports;

use App\Models\Conversation;
use App\Models\Message;
use Exception;
use Illuminate\Support\Facades\DB;

class Chat {
    /**
     * Conversation variable
     *
     * @var [type]
     */
    protected $conversation;

    /**
     * Conversation with variable
     *
     * @var [type]
     */
    protected $conversationWith;

    /**
     * Construct function
     */
    public function __construct()
    {
        $this->conversationWith = [
            'participants' => function($q) {
                $q->where('user_id', '!=', auth()->id());
            },
            'participants.user',
            'lastMessage', 
            'lastMessage.sender'
        ];
    }

    /**
     * Set conversation function
     *
     * @param [type] $conversation
     * @return void
     */
    public function setConversation($conversation)
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * Get conversation function
     *
     * @param [type] $conversation
     * @return void
     */
    public function getConversation()
    {
        return $this->conversation
            ->load($this->conversationWith);
    }

    /**
     * Create conversation function
     *
     * @param [type] $participants
     * @param array $data
     * @return void
     */
    public function createConversation($participants, $data = [])
    {
        if(!is_array($participants)) {
            $participants = [$participants];
        }

        $this->findPrivateConversation($participants[0]);
        
        if(blank($this->conversation)) {
            $conversation = app(Conversation::class)->create([
                'data' => count($data) ? json_encode($data) : null,
                'user_id' => auth()->id()
            ]);
    
            $type = count($participants) > 1 ? 'group' : 'private';
    
            array_push($participants, auth()->id());
            
            foreach ($participants as $key => $participant) {
                $conversation->participants()->create([
                    'user_id' => $participant,
                    'type' => $type
                ]);
            }

            $this->setConversation($conversation);
        }

        return $this;
    }

    /**
     * Add setting conversation function
     *
     * @param array $data
     * @return void
     */
    public function addSetting($data = [])
    {
        if(blank($this->conversation)) {
            throw new Exception('Conversaition is not exists!');
        }

        $this->conversation->update([
            'data' => json_encode($data)
        ]);

        return $this;
    }

    /**
     * Get conversation by id function
     *
     * @param [type] $conversaion
     * @return void
     */
    public function conversation($conversation = null)
    {
        $this->setConversation($conversation);

        return $this;
    }

    /**
     * Add participant function
     *
     * @param [type] $user
     * @return void
     */
    public function addParticipant($user)
    {
        if(blank($this->conversation)) {
            throw new Exception('Conversaition is not exists!');
        }

        if($this->conversation->participants->count() <= 2) {
            throw new Exception('Conversation is private!');
        }

        $participants = $this->conversation->participants->pluck('id')->toArray() ?? [];
        if(in_array($user, $participants)) {
            throw new Exception("Participant is exists in conversation!");
        }

        $this->conversation->participants()->create([
            'user_id' => $user,
            'type' => 'group'
        ]);

        return $this;
    }

    /**
     * Remove participant function
     *
     * @param [type] $user
     * @return void
     */
    public function removeParticipant($user)
    {
        if(blank($this->conversation)) {
            throw new Exception('Conversaition is not exists!');
        }

        if($this->conversation->participants->count() <= 2) {
            throw new Exception('Conversation is private!');
        }

        $participant = $this->participant->whereUserId($user)
            ->whereConversationId($this->conversation->id);

        if(blank($participant)) {
            throw new Exception("Participant is not exists in conversation!");
        }

        $participant->delete();

        return $this;
    }

    /**
     * Find private conversation function
     *
     * @param [type] $user
     * @return void
     */
    public function findPrivateConversation($user)
    {
        $conversation = app(Conversation::class)
            ->whereHas('participants', function($q) use($user) {
                $q->where('user_id', $user)
                    ->where('type', 'private')
                    ->whereExists(function($q) {
                        $q->select(DB::raw(1))
                            ->from(DB::raw('participants as m2'))
                            ->whereColumn('m2.conversation_id', 'participants.conversation_id')
                            ->where('m2.user_id', auth()->id())
                            ->where('type', 'private');
                    });
            })
            ->first();

        $this->setConversation($conversation);

        return $this;
    }

    /**
     * Get participants function
     *
     * @return void
     */
    public function getParticipants()
    {
        return $this->conversation->participants;
    }

    /**
     * Send message function
     *
     * @param [type] $message
     * @return void
     */
    public function send($message, $type = 'text', $attachment = null, $parent = null)
    {
        $participant = collect($this->getParticipants())->firstWhere('user_id', auth()->id());
        
        $message = $this->conversation->conversations()->create([
            'sender_id' => auth()->id(),
            'participant_id' => $participant->id,
            'conversation_type' => $type,
            'message' => $message,
            'message_attachment_url' => $attachment,
            'parent_id' => $parent
        ]);

        return $message->load('sender');
    }

    /**
     * Get message function
     *
     * @param [type] $nextToken
     * @return void
     */
    public function getMessages($last_id = 0, $limit = 12)
    {
        $messages = app(Message::class)
            ->load('sender')
            ->orderByDesc('created_at')
            ->when($last_id != 0, function($q) use($last_id) {
                $q->where('id', '<', $last_id);
            })
            ->where('conversation_id', $this->conversation->id ?? null)
            ->limit($limit)
            ->get();

        return collect()
            ->put('messages', collect($messages->reverse())->values())
            ->put('last_message_id', $messages->last()->id ?? null);
    }

    /**
     * Get conversaions function
     *
     * @param integer $last_id
     * @param integer $limit
     * @return void
     */
    public function getConversations($last_id = 0, $limit = 12)
    {
        $conversations = app(Conversation::class)
            ->with($this->conversationWith)
            ->join(DB::raw('(SELECT MAX(id), MAX(created_at) as last_message_created_at, conversation_id FROM messages GROUP BY conversation_id) msg_max'), function($join) {
                $join->on('msg_max.conversation_id', '=', 'conversations.id');
            })
            ->whereHas('participants', function($q) {
                $q->where('participants.user_id', auth()->id());
            })
            ->orderByDesc('last_message_created_at')
            ->when($last_id != 0, function($q) use($last_id) {
                $q->where('id', '<', $last_id);
            })
            ->limit($limit)
            ->get();

        return collect()
            ->put('conversations', $conversations)
            ->put('last_conversation_id', $conversations->last()->id ?? null);
    }
}