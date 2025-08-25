<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        
        return [
            'id' => $this->id,
            'about' => $this->getTranslations('about'),
            'mission' => $this->getTranslations('mission'),
            'vision' => $this->getTranslations('vision'),
            'seo' => new SeoResource($this->whenLoaded('seo')),
            'histories' => HistoryResource::collection($this->whenLoaded('histories')),

        ];
    }
}
