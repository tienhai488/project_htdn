<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $order = Order::find($this->id);
        return [
            'id' => $this->id,
            'approved_by' => $this->whenLoaded('approvedBy'),
            'approved_at' => formatDate($this->approved_at, 'd/m/Y'),
            'customer' => $this->whenLoaded('customer'),
            'payment_status' => $this->payment_status->getStatus(),
            'delivery_status' => $this->delivery_status->getStatus(),
            'shipping_unit' => $this->whenLoaded('shippingUnit'),
            'note' => $this->note,
            'total_amount' => number_format(getTotalOrderAmount($order)),
            'count_quantity_products' => getCountQuantityProductInOrder($order),
        ];
    }
}
