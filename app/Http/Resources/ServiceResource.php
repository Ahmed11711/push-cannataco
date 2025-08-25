<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'icon' => $this->icon ? asset('storage/' . $this->icon) : null,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'image_alt' => $this->image_alt,
            'seo' => new SeoResource($this->whenLoaded('seo')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
