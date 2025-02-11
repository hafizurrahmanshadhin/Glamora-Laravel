<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConversationUpdated implements ShouldBroadcastNow {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The conversation data array.
     *
     * Expected keys:
     * - user_id: The id of the user receiving this broadcast.
     * - with_user: The id of the other participant.
     * - last_message: The text of the last message.
     * - timestamp: When the message was sent.
     */
    public array $conversationData;

    /**
     * Create a new event instance.
     *
     * @param  array  $conversationData
     * @return void
     */
    public function __construct(array $conversationData) {
        $this->conversationData = $conversationData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * We broadcast on the private channel for the target user.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() {
        return new PrivateChannel('chat.' . $this->conversationData['user_id']);
    }

    /**
     * (Optional) Customize the data sent with the broadcast.
     *
     * @return array
     */
    public function broadcastWith() {
        return $this->conversationData;
    }
}
