<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory {
    protected $model = Message::class;

    public function definition(): array {
        // Find a client and an beauty_expert
        $clientId = User::where('role', 'client')->inRandomOrder()->value('id');
        $expertId = User::where('role', 'beauty_expert')->inRandomOrder()->value('id');

        // Randomly decide the sender
        $senderId   = $this->faker->boolean ? $clientId : $expertId;
        $receiverId = ($senderId === $clientId) ? $expertId : $clientId;

        // Sometimes attach files (some images, some docs)
        $attachments = null;
        if ($this->faker->boolean(30)) {
            $possibleAttachments = [
                'frontend/uploads/home-images/home-banner_1740888946.png',
                'frontend/api_sample.pdf',
                'frontend/uploads/home-user-type-1.png',
            ];

            // Random pick 1-3 attachments
            $randomCount = $this->faker->numberBetween(1, 3);
            $attachments = $this->faker->randomElements($possibleAttachments, $randomCount);
        }

        return [
            'sender_id'   => $senderId,
            'receiver_id' => $receiverId,
            'message'     => $this->faker->sentence(8),
            'attachments' => $attachments,
            'status'      => 'active',
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
