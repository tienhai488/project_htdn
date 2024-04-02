<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
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
            'approved_at' => Carbon::parse($this->approved_at)->format('H:i:s d/m/Y'),
            'approved_by' => $this->approvedBy,
            'supplier' => $this->supplier,
            'note' => $this->note,
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
