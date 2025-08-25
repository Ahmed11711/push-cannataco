<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->getTranslations('title'),
            'desc'       => $this->getTranslations('desc'),
            'btn_text'   => $this->getTranslations('btn_text'),
            'btn_link'   => $this->btn_link,
            'image'      => $this->image ? asset('storage/' . $this->image) : null,
            'image_alt'  => $this->image_alt,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
