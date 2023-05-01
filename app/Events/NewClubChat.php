<?php

namespace App\Events;

use App\Models\ClubChatRoom;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NewClubChat implements ShouldBroadcast
{
    use SerializesModels;

    public $club_chat;

    /**
     * Create a new event instance.
     *
     * @param  ClubChatRoom $club_chat
     * @return void
     */
    public function __construct(ClubChatRoom $club_chat)
    {
        $this->club_chat = $club_chat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['private-club-chat-room.' . $this->club_chat->user_id];
    }

    /**
     * Get the name of the event that should be broadcast.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'new-clubchat';
    }
}
