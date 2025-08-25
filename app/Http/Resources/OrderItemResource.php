<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'weight' => $this->weight,
            'shipping_method_id' => $this->shipping_method_id,
            'shipping_price_per_kg' => optional($this->shippingMethod)->price,
            'total_price' => $this->weight * (optional($this->shippingMethod)->price ?? 0),
            'note' => $this->note,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
