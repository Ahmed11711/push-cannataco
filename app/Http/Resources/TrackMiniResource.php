<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackMiniResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from' => [
                'country' => $this->countrySender?->name,
                'city'    => $this->citySender?->name,
                'state'   => $this->stateSender?->name,
            ],
            'to' => [
                'country' => $this->countryReceived?->name,
                'city'    => $this->cityReceived?->name,
                'state'   => $this->stateReceived?->name,
            ],
        ];
    }
}
