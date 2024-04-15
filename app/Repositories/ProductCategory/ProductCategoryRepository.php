<?php

namespace App\Repositories\ProductCategory;

use App\Models\ProductCategory;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(ProductCategory $model)
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

        $query->withCount('products');

        return $query->orderByDesc('created_at')->paginate(self::PER_PAGE);
    }

    public function destroy($model)
    {
        if ($model->products()->count()) {
            return [
                'icon' => 'error',
                'title' => 'Xoá danh mục sản phẩm không thành công. Dữ liệu đang tồn tại các sản phẩm.',
            ];
        }

        return $model->delete();
    }
}
