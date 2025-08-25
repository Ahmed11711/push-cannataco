<?php

namespace App\Http\Resources;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'logo' => $this->logo ? asset('storage/' . $this->logo) : null,

            'phone' => $this->phone,
            'phone_two' => $this->phone_two,

            'email' => $this->email,
            'email_two' => $this->email_two,

            'address' => $this->address,

            'working_hours' => $this->working_hours,

            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'locations' => LocationResource::collection($this->whenLoaded('locations')),
        ];
    }
}
