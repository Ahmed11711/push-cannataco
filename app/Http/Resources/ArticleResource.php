<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
        'content' => $this->getTranslations('content'),
        'slug' => $this->slug,
        'image' => $this->image ? asset('storage/' . $this->image) : null,
        'image_alt' => $this->image_alt,
        'is_published' => $this->is_published,
        'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        'seo' => new SeoResource($this->whenLoaded('seo')),
    ];
}
}
