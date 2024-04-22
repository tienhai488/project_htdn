<?php

namespace App\Http\Resources;

use App\Models\PurchaseOrder;
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
        $purchaseOrder = PurchaseOrder::find($this->id);
        return [
            'id' => $this->id,
            'approved_at' => Carbon::parse($this->approved_at)->format('d/m/Y'),
            'approved_by' => $this->whenLoaded('approvedBy'),
            'supplier' => $this->whenLoaded('supplier'),
            'note' => $this->note,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'total_amount' => number_format(getTotalPurchaseOrderAmount($purchaseOrder)),
        ];
    }
}
