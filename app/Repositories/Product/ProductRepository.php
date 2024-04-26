<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    const PER_PAGE = 10;
    const STATISTIC_PER_PAGE = 100;

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
            'productPrices',
        ]);

        return $query->latest()->paginate(self::PER_PAGE);
    }

    public function getDataForPurchaseOrderStatistic(array $searchArr)
    {
        $query = $this->model->query();

        $keyword = Arr::get($searchArr, 'keyword', '');
        $product_category_id = Arr::get($searchArr, 'product_category_id', '');

        if ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        if ($product_category_id) {
            $query->where('category_id', $product_category_id);
        }

        $query->with([
            'category',
            'productPrices',
            'purchaseOrders',
            'purchaseOrderProductPrices',
            'orders',
            'orderProductPrices',
        ]);

        return $query->latest()->paginate(self::STATISTIC_PER_PAGE);
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

        $product->productPrices()->create([
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

        $product->productPrices()->firstOrCreate([
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

    public function destroy($model)
    {
        if ($model->purchaseOrders()->count() || $model->orders()->count()) {
            return [
                'icon' => 'error',
                'title' => 'Xoá sản phẩm không thành công. Dữ liệu đang tồn tại các hóa đơn.',
            ];
        }

        return $model->delete();
    }

    public function getProductListForOrder()
    {
        return $this->model->where('quantity', '>', 0)->latest()->get();
    }
}
