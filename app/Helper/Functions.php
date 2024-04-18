<?php

use App\Models\Order;
use App\Models\ProductPrice;
use App\Models\PurchaseOrder;
use Carbon\Carbon;

function getTotalOrderAmount(Order $order)
{
    $data = $order->product_prices;

    return $data->sum(function ($productPrice) {
        $salePrice = $productPrice->sale_price;
        $quantity = $productPrice->pivot->quantity;
        return $quantity * $salePrice;
    });
}

function getCountQuantityProductInOrder(Order $order)
{
    $data = $order->products;

    return $data->sum(function ($product) {
        return $product->pivot->quantity;
    });
}

function getOrderStatistic($orders)
{
    $statistic = $orders->map(function ($order) {
        $totalQuantity = getCountQuantityProductInOrder($order);

        $revenue = getTotalOrderAmount($order);

        $data = $order->product_prices;

        $profit = $revenue - $data->sum(function ($productPrice) {
            $quantity = $productPrice->pivot->quantity;
            $regularPrice = $productPrice->regular_price;
            return $quantity * $regularPrice;
        });

        return [
            'totalQuantity' => $totalQuantity,
            'revenue' => $revenue,
            'profit' => $profit,
        ];
    });

    return [
        'totalQuantity' => number_format($statistic->sum(function ($value) {
            return $value['totalQuantity'];
        })),
        'profit' => $statistic->sum(function ($value) {
            return $value['profit'];
        }),
        'revenue' => $statistic->sum(function ($value) {
            return $value['revenue'];
        }),
    ];
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

function getNow()
{
    return Carbon::now()->format('Y-m-d');
}
