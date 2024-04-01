<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Customer $model)
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
}