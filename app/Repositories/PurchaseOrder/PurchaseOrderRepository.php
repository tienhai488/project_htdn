<?php

namespace App\Repositories\PurchaseOrder;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class PurchaseOrderRepository extends BaseRepository implements PurchaseOrderRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(PurchaseOrder $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function getDataForDatatable(array $searchArr)
    {
        $query = $this->model->query();

        $keyword = Arr::get($searchArr, 'search', '');

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->whereHas('supplier', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        return $query->orderByDesc('created_at')->paginate(self::PER_PAGE);
    }

    public function create($data)
    {
        $purchaseOrderData = [
            'approved_at' => Carbon::now(),
            'approved_by' => auth()->id(),
            'supplier_id' => $data['supplier_id'],
            'note' => $data['note'],
        ];

        $purchaseOrder = $this->model->create($purchaseOrderData);

        $detailData = [];

        foreach ($data['product_id'] as $key => $product_id) {
            $quantity = $data['product_quantity'][$key];
            $product = Product::find($product_id);
            $productPriceId = $product->productPrices()->orderByDesc('created_at')->first()->id;

            $detailData[$product_id] = [
                'quantity' => $quantity,
                'product_price_id' => $productPriceId,
            ];

            $product->update(
                [
                    'quantity' => $product->quantity + $quantity,
                ],
            );
        }

        $purchaseOrder->products()->attach($detailData);

        return $purchaseOrder;
    }

    public function update($purchaseOrder, $data)
    {
        $purchaseOrderProducts = $purchaseOrder->products()->withPivot('quantity')->get();

        foreach ($purchaseOrderProducts as $product) {
            $oldQuantity = $product->pivot->quantity;
            $product->update(
                [
                    'quantity' => $product->quantity - $oldQuantity,
                ]
            );
        }

        $purchaseOrderData = [
            'approved_at' => Carbon::now(),
            'approved_by' => auth()->id(),
            'supplier_id' => $data['supplier_id'],
            'note' => $data['note'],
        ];

        $purchaseOrder->update($purchaseOrderData);

        $detailData = [];

        foreach ($data['product_id'] as $key => $product_id) {
            $quantity = $data['product_quantity'][$key];
            $product = Product::find($product_id);
            $productPriceId = $product->productPrices()->orderByDesc('created_at')->first()->id;

            $detailData[$product_id] = [
                'quantity' => $quantity,
                'product_price_id' => $productPriceId,
            ];

            $product->update(
                [
                    'quantity' => $product->quantity + $quantity,
                ],
            );
        }

        $purchaseOrder->products()->sync($detailData);

        return $purchaseOrder;
    }

    public function getDataForPurchaseOrderStatistic(string $product_category_id, string $startDate, string $endDate)
    {
        $purchaseOrders = $this->model->with(['products', 'productPrices'])->get();

        $productsList = [];

        foreach ($purchaseOrders as $purchaseOrder) {
            $products = $purchaseOrder->products;
            $productPrices = $purchaseOrder->productPrices;

            foreach ($products as $index => $product) {
                $found = false;
                $quantity = $product->pivot->quantity;
                $regularPrice = $productPrices[$index]->regular_price;

                foreach ($productsList as &$item) {
                    if ($item['product']->id == $product->id) {
                        $item['total'] += $quantity * $regularPrice;
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    $quantity =
                        $productsList[$product->id] = [
                            'product' => $product,
                            'total' => $quantity * $regularPrice,
                        ];
                }
            }
        }

        return $productsList;
    }
}
