<?php

namespace App\Repositories\Supplier;

use App\Models\Supplier;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Supplier $model)
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

        return $query->orderByDesc('created_at')->paginate(self::PER_PAGE);
    }

    public function destroy($model)
    {
        if ($model->purchaseOrders()->count()) {
            return [
                'icon' => 'error',
                'title' => 'Xoá nhà cung cấp không thành công. Dữ liệu đang tồn tại các hóa đơn nhập.',
            ];
        }

        return $model->delete();
    }
}
