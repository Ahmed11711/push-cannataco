<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'sender_id' => $this->sender_id,
            'sender_type' => class_basename($this->sender_type),
            'receiver_id' => $this->receiver_id,
            'receiver_type' => class_basename($this->receiver_type),
            'is_seen' => $this->is_seen,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
