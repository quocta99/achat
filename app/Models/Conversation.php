<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Conversation extends Model
{
    protected $table = 'conversations';
    protected $guarded = [];

    /**
     * Participants function
     *
     * @return HasMany
     */
    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    /**
     * Messages function
     *
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Last message function
     *
     * @return HasOne
     */
    public function lastMessage(): HasOne
    {
        return $this->hasOne(Message::class)
            ->orderByDesc('id');
    }

    /**
     * Data attribute function
     *
     * @param [type] $value
     * @return void
     */
    public function getDataAttribute($value)
    {
        return !blank($value) ? json_decode($value, true) ?? [] : [];
    }

}