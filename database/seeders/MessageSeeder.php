<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder {
    public function run(): void {
        $clients = User::where('role', 'client')->get();
        $experts = User::where('role', 'beauty_expert')->get();

        // For each client-expert pair, create a conversation
        foreach ($clients as $client) {
            foreach ($experts as $expert) {
                $messageCount = rand(50, 100);

                for ($i = 0; $i < $messageCount; $i++) {
                    // Randomly decide who sends each message in this conversation
                    $isClientSending = rand(0, 1);

                    Message::factory()->create([
                        'sender_id'   => $isClientSending ? $client->id : $expert->id,
                        'receiver_id' => $isClientSending ? $expert->id : $client->id,
                    ]);
                }
            }
        }
    }
}
