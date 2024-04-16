<?php

namespace App\Repositories\Department;

use App\Models\Department;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Department $model)
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

        $query->withCount('users');

        return $query->latest()->paginate(self::PER_PAGE);
    }

    public function destroy($model)
    {
        if ($model->users()->count()) {
            return [
                'icon' => 'error',
                'title' => 'Xoá phòng ban không thành công. Phòng ban đang tồn tại thành viên.',
            ];
        }

        return $model->delete();
    }
}
