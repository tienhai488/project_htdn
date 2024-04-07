<?php

namespace App\Http\Resources;

use App\Models\Order;
use Carbon\Carbon;
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
            'approved_by' => $this->approvedBy,
            'approved_at' => Carbon::parse($this->approved_at)->format('d/m/Y'),
            'customer' => $this->customer,
            'payment_status' => $this->payment_status,
            'payment_status_description' => $this->payment_status->getDescription(),
            'payment_status_type' => $this->payment_status->getTypeButton(),
            'total_amount' => number_format(getTotalOrderAmount($order)),
            'delivery_status' => $this->delivery_status,
            'delivery_status_description' => $this->delivery_status->getDescription(),
            'shipping_unit' => $this->shippingUnit,
            'note' => $this->note,
        ];
    }
}