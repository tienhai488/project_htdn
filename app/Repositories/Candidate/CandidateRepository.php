<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

class CandidateRepository extends BaseRepository implements CandidateRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Candidate $model)
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

        $query->with([
            'recruitment',
            'recruitment.department',
            'recruitment.position',
        ]);

        return $query->latest()->paginate(self::PER_PAGE);
    }

    public function create($data)
    {
        $candidate = $this->model->create($data);

        $candidate
            ->addMediaFromBase64(json_decode($data['cv'])->data)
            ->usingFileName(json_decode($data['cv'])->name)
            ->toMediaCollection(Candidate::CANDIDATE_CV_COLLECTION);

        return $candidate;
    }

    public function update($candidate, $data)
    {
        $candidate->update($data);

        $candidate->clearMediaCollection(Candidate::CANDIDATE_CV_COLLECTION);

        $candidate
            ->addMediaFromBase64(json_decode($data['cv'])->data)
            ->usingFileName(json_decode($data['cv'])->name)
            ->toMediaCollection(Candidate::CANDIDATE_CV_COLLECTION);

        return $candidate;
    }

    public function destroy($model)
    {
        if (!$model->status->isAllowDelete()) {
            return [
                'icon' => 'error',
                'title' => 'Xoá ứng viên không thành công. Chỉ được xóa khi ở trạng thái chờ duyệt và từ chối.',
            ];
        }

        return $model->delete();
    }
}
