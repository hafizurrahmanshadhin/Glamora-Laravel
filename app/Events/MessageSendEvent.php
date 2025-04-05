<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSendEvent implements ShouldBroadcastNow {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function broadcastOn(): array {
        return [
            new PrivateChannel('chat-channel.' . $this->message->receiver_id),
        ];
    }

    public function broadcastWith(): array {
        $avatar = $this->message->sender->avatar
        ? asset($this->message->sender->avatar)
        : asset('backend/images/default_images/user_1.jpg');

        return [
            'id'         => $this->message->id,
            'message'    => $this->message->message,
            'sender'     => [
                'id'         => $this->message->sender->id,
                'first_name' => $this->message->sender->first_name,
                'last_name'  => $this->message->sender->last_name,
                'avatar'     => $avatar,
            ],
            // 'created_at' => $this->message->created_at->format('H:i'),
            // Use 12-hour format with AM/PM
            'created_at' => $this->message->created_at->format('h:i A'),
        ];
    }
}
