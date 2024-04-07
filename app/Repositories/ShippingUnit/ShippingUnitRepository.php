<?php

namespace App\Repositories\ShippingUnit;

use App\Models\ShippingUnit;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

class ShippingUnitRepository extends BaseRepository implements ShippingUnitRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(ShippingUnit $model)
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

            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        return $query->latest()->paginate(self::PER_PAGE);
    }
}
