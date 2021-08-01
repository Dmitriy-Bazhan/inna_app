<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user_id;
    public $username;
    public $created_at;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $user_id, $username)
    {
        $this->message = $message;
        $this->user_id = $user_id;
        $this->username = $username;
        $this->created_at = Carbon::now();;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->user_id );
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'user_id' => $this->user_id,
            'username' => $this->username,
            'created_at' => $this->created_at
        ];
    }
}
