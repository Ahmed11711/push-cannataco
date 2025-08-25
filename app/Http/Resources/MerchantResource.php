<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'phone2'      => $this->phone2,
            'image'       => $this->image ? asset('storage/' . $this->image) : null,
            'status'      => $this->status,
            'country'     => $this->country,
            'city'        => $this->city,
            'state'       => $this->state,
            'address'     => $this->address_company ?? $this->address_warehouse,
            'description' => $this->description,
            'google_id'   => $this->google_id,
            'facebook_id' => $this->facebook_id,
            // الرسائل
            'latest_message' => $this->whenLoaded('latestMessage', function () {
                return new MessageResource($this->latestMessage);
            }),

            'messages' => $this->whenLoaded('messages', function () {
                return MessageResource::collection($this->messages);
            }),
        ];
    }
}
