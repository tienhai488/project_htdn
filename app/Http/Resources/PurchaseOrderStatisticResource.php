<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderStatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = Product::find($this->id);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'thumbnail' => $this->thumbnail,
            'statistic' => getDataForPurchaseOrderStatistic($product, $request->start_date, $request->end_date),
        ];
    }
}