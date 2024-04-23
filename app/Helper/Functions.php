<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\PurchaseOrder;
use Carbon\Carbon;

function getTotalOrderAmount(Order $order)
{
    $data = $order->productPrices;

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

        $data = $order->productPrices;

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
    $data = $purchaseOrder->productPrices;

    $totalAmount = $data->sum(function ($productPrice) {
        $quantity = $productPrice->pivot->quantity;
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

function getNowFormat($format = 'd/m/Y')
{
    return Carbon::now()->format($format);
}

function getStartOfYearFormat($format = 'd/m/Y')
{
    return Carbon::now()->startOfYear()->format($format);
}

function getDataForPurchaseOrderStatistic(Product $product, $startDate, $endDate)
{
    $startDate = $startDate ? Carbon::createFromFormat('d/m/Y', $startDate) : Carbon::now()->startOfYear();
    $endDate = $endDate ? Carbon::createFromFormat('d/m/Y', $endDate)->addDays() : Carbon::now();

    $data = [
        'start_import_quantity' => 0,
        'start_import_total' => 0,
        'start_export_quantity' => 0,
        'start_export_total' => 0,
        'end_quantity' => 0,
        'end_total' => 0,
    ];

    if ($startDate->greaterThan($endDate)) {
        return $data;
    }

    $purchaseOrders = $product->purchaseOrders;
    $purchaseOrderProductPrices = $product->purchaseOrderProductPrices;
    $orders = $product->orders;
    $orderProductPrices =  $product->orderProductPrices;

    foreach ($purchaseOrders as $key => $purchaseOrder) {
        $quantity = $purchaseOrder->pivot->quantity;
        $regularPrice = $purchaseOrderProductPrices[$key]->regular_price;

        if ($purchaseOrder->approved_at->greaterThan($startDate) && $purchaseOrder->approved_at->lessThan($endDate)) {
            $data['start_import_quantity'] +=  $quantity;
            $data['start_import_total'] += $quantity * $regularPrice;
        }

        if ($purchaseOrder->approved_at->lessThan($endDate)) {
            $data['end_quantity'] +=  $quantity;
        }
    }

    foreach ($orders as $key => $order) {
        $quantity = $order->pivot->quantity;
        $salePrice = $orderProductPrices[$key]->sale_price;

        if ($order->delivery_status->isAccept() && $order->approved_at->greaterThan($startDate) && $order->approved_at->lessThan($endDate)) {
            $data['start_export_quantity'] +=  $quantity;
            $data['start_export_total'] += $quantity * $salePrice;
        }

        if ($order->delivery_status->isAccept() && $order->approved_at->lessThan($endDate)) {
            $data['end_quantity'] -=  $quantity;
        }
    }

    $data['end_total'] = $data['end_quantity'] * $product->sale_price;

    $data['start_import_quantity'] = number_format($data['start_import_quantity']);
    $data['start_import_total'] = number_format($data['start_import_total']);
    $data['start_export_quantity'] = number_format($data['start_export_quantity']);
    $data['start_export_total'] = number_format($data['start_export_total']);
    $data['end_quantity'] = number_format($data['end_quantity']);
    $data['end_total'] = number_format($data['end_total']);

    return $data;
}