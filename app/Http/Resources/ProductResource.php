<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'quantity' => $this->quantity,
            'category' => $this->category,
            'description' => htmlspecialchars($this->description),
            'thumbnail' => $this->thumbnail,
            'sale_price' => number_format($this->sale_price),
            'regular_price' => number_format($this->regular_price),
        ];
    }
}