<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return      ['image' => $this->image ? asset('storage/' . $this->image) : null];
    }
}
