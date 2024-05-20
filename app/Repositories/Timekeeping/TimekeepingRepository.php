<?php

namespace App\Repositories\Timekeeping;

use App\Enums\WorkingStatus;
use App\Models\Timekeeping;
use App\Repositories\BaseRepository;

class TimekeepingRepository extends BaseRepository implements TimekeepingRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Timekeeping $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function getDataTimekeepingForUser($user, $data)
    {
        $month = $data['month'];
        $year = $data['year'];
        $timekeeping = $user->timekeepings()->where('month', $month)->where('year', $year)->first();

        if (empty($timekeeping)) {
            return [];
        }

        $timekeepingDetails = $timekeeping->timekeepingDetails;

        $data = [];

        if ($timekeepingDetails->count()) {
            foreach ($timekeepingDetails as $detail) {
                $data[] = [
                    'working_status' => $detail->working_status,
                    'work_type' => $detail->work_type,
                    'ot_time' => round($detail->ot, 4),
                    'date' => $detail->date,
                ];
            }
        }

        return $data;
    }

    public function updateTimekeepingForUser($user, $data)
    {
        $month = $data['month'];
        $year = $data['year'];
        $data = $data['data'];

        $timekeeping = $user->timekeepings()->updateOrCreate([
            'approved_by' => auth()->id(),
            'month' => $month,
            'year' => $year,
        ]);

        $timekeeping->timekeepingDetails()->delete();

        $arr = [];

        if (!empty($data)) {
            foreach ($data as $item) {
                $arr[$item['startStr']][$item['type']] = $item['data'];
            }
        }

        if (!empty($arr)) {
            foreach ($arr as $key => $item) {
                $dataDetail = [
                    'working_status' => $item['working-status'] ?? WorkingStatus::WORK,
                    'work_type' => $item['work-type'] ?? null,
                    'date' => $key,
                    'ot' => $item['ot-time'] ?? 0,
                ];
                $timekeeping->timekeepingDetails()->create($dataDetail);
            }
        }

        return $timekeeping;
    }
}
