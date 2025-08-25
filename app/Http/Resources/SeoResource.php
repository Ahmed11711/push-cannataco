<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
           return [
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'canonical_url' => $this->canonical_url,
            'meta_robots' => $this->meta_robots,
            'og_image' => $this->og_image,
        ];
    }
}
