<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'merchant_id' => $this->merchant_id,
            'track_id' => $this->track_id,
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'serial_number' => $this->serial_number,

            'sender' => [
                'name' => $this->name_sender,
                'phone' => $this->phone_sender,
                'email' => $this->email_sender,
                'address' => $this->address_sender,
            ],

            'receiver' => [
                'name' => $this->name_received,
                'phone' => $this->phone_received,
                'email' => $this->email_received,
            ],

            'delivered_at' => $this->delivered_at,
            'created_at' => $this->created_at,
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
