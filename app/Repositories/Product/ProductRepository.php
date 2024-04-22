<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Product $model)
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

            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        $query->with([
            'category',
            'product_prices',
            'purchaseOrders',
            'purchaseOrderProductPrices',
            'orders',
            'orderProductPrices',
        ]);

        return $query->orderByDesc('created_at')->paginate(self::PER_PAGE);
    }

    public function create($data)
    {
        $productData = [
            'name' => $data['name'],
            'quantity' => $data['quantity'] ?? 0,
            'category_id' => $data['category_id'],
            'description' => $data['description'],
        ];

        $product = $this->model->create($productData);

        $product->product_prices()->create([
            'product_id' => $product->id,
            'sale_price' => $data['sale_price'],
            'regular_price' => $data['regular_price'],
        ]);

        $product
            ->addMediaFromBase64(json_decode($data['thumbnail'])->data)
            ->usingFileName(json_decode($data['thumbnail'])->name)
            ->toMediaCollection(Product::PRODUCT_THUMBNAIL_COLLECTION);

        foreach ($data['images'] as $image) {
            $product
                ->addMediaFromBase64(json_decode($image)->data)
                ->usingFileName(json_decode($image)->name)
                ->toMediaCollection(Product::PRODUCT_IMAGES_COLLECTION);
        }

        return $product;
    }

    public function update($product, $data)
    {
        $productData = [
            'name' => $data['name'],
            'quantity' => $data['quantity'] ?? 0,
            'category_id' => $data['category_id'],
            'description' => $data['description'],
        ];

        $product->update($productData);

        $product->product_prices()->firstOrCreate([
            'sale_price' => $data['sale_price'],
            'regular_price' => $data['regular_price'],
        ]);

        $product->clearMediaCollection(Product::PRODUCT_THUMBNAIL_COLLECTION);
        $product
            ->addMediaFromBase64(json_decode($data['thumbnail'])->data)
            ->usingFileName(json_decode($data['thumbnail'])->name)
            ->toMediaCollection(Product::PRODUCT_THUMBNAIL_COLLECTION);

        $product->clearMediaCollection(Product::PRODUCT_IMAGES_COLLECTION);
        foreach ($data['images'] as $image) {
            $product
                ->addMediaFromBase64(json_decode($image)->data)
                ->usingFileName(json_decode($image)->name)
                ->toMediaCollection(Product::PRODUCT_IMAGES_COLLECTION);
        }

        return $product;
    }

    public function getProductListForOrder()
    {
        return $this->model::where('quantity', '>', 0)->latest()->get();
    }

    public function getDataForPurchaseOrderStatistic()
    {
        $products =  $this->model->with([
            'purchaseOrders',
            'purchaseOrderProductPrices',
            'orders',
            'orderProductPrices',
        ])->latest()->get();

        $data = [];

        foreach ($products as $product) {
            $purchaseOrders = $product->purchaseOrders;
            $purchaseOrderProductPrices = $product->purchaseOrderProductPrices;
            $orders = $product->orders;
            $orderProductPrices =  $product->orderProductPrices;

            $data[$product->id] = [
                'start_import_quantity' => 0,
                'start_import_total' => 0,
                'start_export_quantity' => 0,
                'start_export_total' => 0,
                'end_quantity' => 0,
                'end_total' => 0,
            ];

            foreach ($purchaseOrders as $key => $purchaseOrder) {
                $quantity = $purchaseOrder->pivot->quantity;
                $regularPrice = $purchaseOrderProductPrices[$key]->regular_price;
                $data[$product->id]['start_import_quantity'] +=  $quantity;
                $data[$product->id]['start_import_total'] += $quantity * $regularPrice;
                $data[$product->id]['end_quantity'] +=  $quantity;
                $data[$product->id]['end_total'] += $quantity * $regularPrice;
            }

            foreach ($orders as $key => $order) {
                $quantity = $order->pivot->quantity;
                $salePrice = $orderProductPrices[$key]->sale_price;
                $data[$product->id]['start_export_quantity'] +=  $quantity;
                $data[$product->id]['start_export_total'] += $quantity * $salePrice;
            }
        }

        return collect($data)->pagination(10);
    }
}
