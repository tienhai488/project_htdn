<?php

use App\Models\Order;
use App\Models\ProductPrice;
use App\Models\PurchaseOrder;
use Carbon\Carbon;

function getTotalOrderAmount(Order $order)
{
    $data = $order->products()->withPivot(['quantity', 'product_price_id'])->get();

    $totalAmount = $data->sum(function ($orderDetail) {
        $productPrice = ProductPrice::find($orderDetail->pivot->product_price_id);
        $quantity = $orderDetail->pivot->quantity;
        $salePrice = $productPrice->sale_price;
        return $quantity * $salePrice;
    });

    return $totalAmount;
}

function getTotalPurchaseOrderAmount(PurchaseOrder $purchaseOrder)
{
    $data = $purchaseOrder->products()->withPivot(['quantity', 'product_price_id'])->get();

    $totalAmount = $data->sum(function ($purchaseOrderDetail) {
        $productPrice = ProductPrice::find($purchaseOrderDetail->pivot->product_price_id);
        $quantity = $purchaseOrderDetail->pivot->quantity;
        $regularPrice = $productPrice->regular_price;
        return $quantity * $regularPrice;
    });

    return $totalAmount;
}

function formatDate($datetime, $format = 'd/m/Y H:i:s')
{
    if (!$datetime) {
        return '';
    }
    return Carbon::parse($datetime)->format($format);
}
