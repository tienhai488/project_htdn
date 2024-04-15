<?php

namespace App\Repositories\Position;

use App\Models\Position;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

class PositionRepository extends BaseRepository implements PositionRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Position $model)
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

        return $query->latest()->paginate(self::PER_PAGE);
    }

    public function destroy($model)
    {
        if ($model->salaries()->count()) {
            return [
                'icon' => 'error',
                'title' => 'Xoá vị trí không thành công. Dữ liệu đã tồn tại trong lịch sử lương.',
            ];
        }

        return $model->delete();
    }
}
