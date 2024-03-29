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

        $query->with(['category']);

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
}