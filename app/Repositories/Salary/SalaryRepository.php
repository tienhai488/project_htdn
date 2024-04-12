<?php

namespace App\Repositories\Salary;

use App\Enums\SalaryStatus;
use App\Models\Salary;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class SalaryRepository extends BaseRepository implements SalaryRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Salary $model)
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

            $query->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        return $query->orderByDesc('created_at')->paginate(self::PER_PAGE);
    }

    public function create($data)
    {
        $salaryData = [
            'user_id' => $data['user_id'],
            'amount' => $data['salary_amount'],
            'position_id' => $data['salary_position_id'],
            'status' => $data['salary_status'],
        ];

        if ($data['salary_status'] == SalaryStatus::APPROVED->value) {
            $salaryData['approved_by'] = auth()->id();
            $salaryData['approved_at'] = Carbon::now();
        }

        return $this->model->create($salaryData);
    }

    function updateSalaryStatus($salary)
    {
        $dataUpdate = [
            'status' => SalaryStatus::APPROVED,
            'approved_at' => Carbon::now(),
            'approved_by' => auth()->id(),
        ];

        return $salary->update($dataUpdate);
    }
}
