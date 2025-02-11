<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

    public function __construct(Message $message) {
        $this->message = $message;
    }

    /**
     *! Determine the channels the event should broadcast on.
     *
     * @return array The list of channels where this event will be broadcasted.
     */
    public function broadcastOn(): array {
        //* Broadcasts to a private channel specific to the receiver of the message
        return [
            new PrivateChannel("chat.{$this->message->receiver_id}"),

            //! Broadcasts to a private channel specific to the sender of the message
            // new PrivateChannel("chat.{$this->message->sender_id}"),
        ];
    }
}
