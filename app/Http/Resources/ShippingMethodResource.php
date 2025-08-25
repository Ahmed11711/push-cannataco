<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingMethodResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'type'  => $this->type,
            'price' => $this->price,
            'track' => new TrackMiniResource($this->whenLoaded('track')),
        ];
    }
}
