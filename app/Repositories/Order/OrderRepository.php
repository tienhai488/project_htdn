<?php

namespace App\Repositories\Order;

use App\Enums\DeliveryStatus;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    function getDataForDatatable(array $searchArr)
    {
        $query = $this->model->query();

        $keyword = Arr::get($searchArr, 'search', '');

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->whereHas('customer', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        return $query->latest()->paginate(self::PER_PAGE);
    }

    public function create($data)
    {
        $orderData = [
            'customer_id' => $data['customer_id'],
            'payment_status' => $data['payment_status'],
            'delivery_status' => $data['delivery_status'],
            'shipping_unit_id' => $data['shipping_unit_id'],
            'note' => $data['note'],
        ];

        if ($data['delivery_status'] != DeliveryStatus::PENDING->value) {
            $orderData['approved_at'] = Carbon::now();
            $orderData['approved_by'] = auth()->id();
        }

        $order = $this->model->create($orderData);

        $detailData = [];

        foreach ($data['product_id'] as $key => $product_id) {
            $quantity = $data['product_quantity'][$key];
            $product = Product::find($product_id);
            $productPriceId = $product->product_prices()->orderByDesc('created_at')->first()->id;

            $detailData[$product_id] = [
                'quantity' => $quantity,
                'product_price_id' => $productPriceId,
            ];

            $product->update(
                [
                    'quantity' => $product->quantity - $quantity,
                ],
            );
        }

        $order->products()->attach($detailData);

        return $order;
    }

    public function update($order, $data)
    {
        $orderProducts = $order->products()->withPivot('quantity')->get();

        foreach ($orderProducts as $product) {
            $oldQuantity = $product->pivot->quantity;
            $product->update(
                [
                    'quantity' => $product->quantity + $oldQuantity,
                ]
            );
        }

        $orderData = [
            'customer_id' => $data['customer_id'],
            'payment_status' => $data['payment_status'],
            'delivery_status' => $data['delivery_status'],
            'shipping_unit_id' => $data['shipping_unit_id'],
            'note' => $data['note'],
        ];

        if ($order->delivery_status->value != $data['delivery_status']) {
            if ($order->delivery_status->isPending()) {
                $orderData['approved_at'] = Carbon::now();
                $orderData['approved_by'] = auth()->id();
            } else {
                if ($data['delivery_status'] == DeliveryStatus::PENDING->value) {
                    $orderData['approved_at'] = null;
                    $orderData['approved_by'] = null;
                }
            }
        }

        $order->update($orderData);

        $detailData = [];

        foreach ($data['product_id'] as $key => $product_id) {
            $quantity = $data['product_quantity'][$key];
            $product = Product::find($product_id);
            $productPriceId = $product->product_prices()->orderByDesc('created_at')->first()->id;

            $detailData[$product_id] = [
                'quantity' => $quantity,
                'product_price_id' => $productPriceId,
            ];

            $product->update(
                [
                    'quantity' => $product->quantity - $quantity,
                ],
            );
        }

        $order->products()->sync($detailData);

        return $order;
    }
}