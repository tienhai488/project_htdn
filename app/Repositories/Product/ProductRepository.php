<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;

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
        // $query = $this->model->query();

        // $keyword = Arr::get($searchArr, 'search', '');

        // if ($keyword) {
        //     if (is_array($keyword)) {
        //         $keyword = $keyword['value'];
        //     }

        //     $query->where('name', 'LIKE', '%' . $keyword . '%');
        // }

        // return $query->orderByDesc('created_at')->paginate(self::PER_PAGE);
    }
}