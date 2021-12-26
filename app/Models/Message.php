<?php 

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $table = 'messages';
    protected $guarded = [];
    
    /**
     * Sender function
     *
     * @return BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    /**
     * Conversation function
     *
     * @return BelongsTo
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id');
    }

    /**
     * Message attachment attribute function
     *
     * @param [type] $value
     * @return void
     */
    public function getMessageAttachmentAttribute($value)
    {
        return !blank($value) ? json_decode($value, true) ?? [] : [];
    }

    /**
     * Readed function
     *
     * @return void
     */
    public function readed()
    {
        return $this->belongsToMany(User::class, 'readed_messages');
    }
}