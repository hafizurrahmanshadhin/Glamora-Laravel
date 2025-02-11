<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array {
        return [
            'id'          => $this->id,
            'sender_id'   => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'text'        => $this->text,
            'sender'      => [
                'id'     => $this->sender->id,
                'name'   => $this->sender->name,
                'avatar' => $this->sender->avatar,
            ],
            'created_at'  => $this->created_at,
        ];
    }
}
