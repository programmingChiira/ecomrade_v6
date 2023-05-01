<?php

namespace App\Events;

use App\Models\ClubChatRoom;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserChatEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

  public function __construct($message)
  {
      $this->message = $message;
  }

  public function broadcastOn()
  {
      //return ['my-channel'];
      return new Channel('my-user-channel');
  }

  public function broadcastAs()
  {
      return 'my-user-event';
  }
}