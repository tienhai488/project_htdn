<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Enums\Gender;
use App\Enums\SalaryStatus;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Department\DepartmentRepositoryInterface;
use App\Repositories\Position\PositionRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected PositionRepositoryInterface $positionRepository,
        protected DepartmentRepositoryInterface $departmentRepository,
    ) {
        $this->middleware('permission:' . Acl::PERMISSION_USER_LIST_HR)->only('index');
        $this->middleware('permission:' . Acl::PERMISSION_USER_ADD_HR)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_USER_EDIT_HR)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_USER_DELETE_HR)->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->userRepository->getDataForDatatable($request->all());
            return UserResource::collection($users);
        }

        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userStatuses = UserStatus::getUserStatuses();
        $positions = $this->positionRepository->all();
        $departments = $this->departmentRepository->all();
        $genders = Gender::getGenders();

        return view(
            'admin.user.create',
            compact(
                'userStatuses',
                'positions',
                'departments',
                'genders',
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->userRepository->create($request->except('_token')) ?
            session()->flash('success', 'Thêm người dùng thành công')
            :
            session()->flash('error', 'Thêm người dùng không thành công');

        return to_route('admin.user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $userProfile = $this->userRepository->getUserProfile($user);
        $userStatuses = UserStatus::getUserStatuses();
        $positions = $this->positionRepository->all();
        $departments = $this->departmentRepository->all();
        $genders = Gender::getGenders();
        $salaryStatuses = SalaryStatus::getSalaryStatuses();
        $approvedSalary = $user->approved_salary;
        $pendingSalary = $user->pending_salary;
        $allApprovedSalary = $this->userRepository->getAllApprovedSalaryUser($user);

        return view(
            'admin.user.edit',
            compact(
                'user',
                'userProfile',
                'userStatuses',
                'positions',
                'departments',
                'genders',
                'salaryStatuses',
                'approvedSalary',
                'pendingSalary',
                'allApprovedSalary',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->except('_token')) ?
            session()->flash('success', 'Cập nhật người dùng thành công')
            :
            session()->flash('error', 'Cập nhật người dùng không thành công');

        return to_route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}