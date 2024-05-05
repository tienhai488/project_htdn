<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Enums\WorkingStatus;
use App\Enums\WorkType;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserTimekeepingResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class TimekeepingController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {
        $this->middleware('permission:' . Acl::PERMISSION_TIMEKEEPING_MANAGE_HR)->only('index');
    }

    public function index(Request $request)
    {
        $workingStatuses = WorkingStatus::getWorkingStatuses();
        $workTypes = WorkType::getWorkTypes();

        if ($request->ajax()) {
            $users = $this->userRepository->getDataForTimekeepingDatatable($request->all());
            return UserTimekeepingResource::collection($users);
        }

        return view(
            'admin.timekeeping.index',
            compact(
                'workingStatuses',
                'workTypes',
            )
        );
    }

    public function data(Request $request, User $user)
    {
        if ($request->ajax()) {
            $month = $request->month;
            $year = $request->year;
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
    }

    public function update(Request $request, User $user)
    {
        if ($request->ajax()) {
            $month = $request->month;
            $year = $request->year;
            $data = $request->data;

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
}
