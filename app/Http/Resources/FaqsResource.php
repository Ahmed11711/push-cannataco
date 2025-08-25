<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
         return [
        'id' => $this->id,
        'title' => $this->getTranslations('key'),
        'content' => $this->getTranslations('value'),
    ];
    }
}
