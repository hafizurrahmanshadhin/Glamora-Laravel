<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSendEvent implements ShouldBroadcastNow {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($message) {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * Here we broadcast on the receiver’s private channel.
     */
    public function broadcastOn(): array {
        return [
            new PrivateChannel('chat-channel.' . $this->message->receiver_id),
        ];
    }

    /**
     * Customize the data that is broadcast.
     */
    public function broadcastWith() {
        return [
            'id'         => $this->message->id,
            'message'    => $this->message->message,
            'sender'     => [
                'id'         => $this->message->sender->id,
                'first_name' => $this->message->sender->first_name,
            ],
            'receiver'   => [
                'id'         => $this->message->receiver->id,
                'first_name' => $this->message->receiver->first_name,
            ],
            'created_at' => $this->message->created_at->format('H:i'),
        ];
    }
}
