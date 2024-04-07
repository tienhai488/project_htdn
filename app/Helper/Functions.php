<?php

use App\Models\Order;
use App\Models\ProductPrice;
use App\Models\PurchaseOrder;
use App\Models\TemporaryFile;

function getImageInStorage($field = '')
{
    $temporaryFile = TemporaryFile::where('field', $field)->orderByDesc('created_at')->first();

    if (empty($temporaryFile)) {
        return '';
    }

    return asset('storage/uploads/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename);
}

function getImageListInStorage($field = '')
{
    $images = TemporaryFile::where('field', $field)->orderByDesc('created_at')->get();

    if (empty($images)) {
        return [];
    }

    $data = [];
    foreach ($images as $temporaryFile) {
        $data[] = asset('storage/uploads/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename);
    }

    return $data;
}

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