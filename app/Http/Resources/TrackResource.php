<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from' => [
                'country' => $this->countrySender?->name,
                'state'   => $this->stateSender?->name,
                'city'    => $this->citySender?->name,
            ],
            'to' => [
                'country' => $this->countryReceived?->name,
                'state'   => $this->stateReceived?->name,
                'city'    => $this->cityReceived?->name,
            ],
            'shipping_methods' => ShippingMethodResource::collection($this->whenLoaded('shippingMethods')),
        ];
    }
}
