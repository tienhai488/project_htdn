<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Enums\WorkingStatus;
use App\Enums\WorkType;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserTimekeepingResource;
use App\Models\User;
use App\Repositories\Timekeeping\TimekeepingRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class TimekeepingController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected TimekeepingRepositoryInterface $timekeepingRepository,
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
            return $this->timekeepingRepository->getDataTimekeepingForUser($user, $request->all());
        }
    }

    public function update(Request $request, User $user)
    {
        if ($request->ajax()) {
            return $this->timekeepingRepository->updateTimekeepingForUser($user, $request->all());
        }
    }
}
