<?php

namespace App\Repositories\Recruitment;

use App\Models\Recruitment;
use App\Repositories\BaseRepository;
use App\Repositories\Recruitment\RecruitmentRepositoryInterface;
use Illuminate\Support\Arr;

class RecruitmentRepository extends BaseRepository implements RecruitmentRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Recruitment $model)
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

            $query->where('title', 'LIKE', '%' . $keyword . '%');
        }

        $query->with(['department', 'position']);

        return $query->latest()->paginate(self::PER_PAGE);
    }
}