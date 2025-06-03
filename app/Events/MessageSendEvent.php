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

        // Build full URLs for each attachment
        $publicUrls = [];
        if (!empty($this->message->attachments) && is_array($this->message->attachments)) {
            foreach ($this->message->attachments as $relPath) {
                $publicUrls[] = asset($relPath);
            }
        }

        return [
            'id'          => $this->message->id,
            'message'     => $this->message->message,
            'attachments' => $publicUrls,
            'sender'      => [
                'id'         => $this->message->sender->id,
                'first_name' => $this->message->sender->first_name,
                'last_name'  => $this->message->sender->last_name,
                'avatar'     => $avatar,
            ],
            'created_at'  => $this->message->created_at->format('h:i A'),
        ];
    }
}
