<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Recruitment\StoreRecruitmentRequest;
use App\Http\Requests\Recruitment\UpdateRecruitmentRequest;
use App\Http\Resources\RecruitmentResource;
use App\Models\Recruitment;
use App\Repositories\Department\DepartmentRepositoryInterface;
use App\Repositories\Position\PositionRepositoryInterface;
use App\Repositories\Recruitment\RecruitmentRepositoryInterface;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    public function __construct(
        protected RecruitmentRepositoryInterface $recruitmentRepository,
        protected DepartmentRepositoryInterface $departmentRepository,
        protected PositionRepositoryInterface $positionRepository,
    ) {
        $this->middleware('permission:' . Acl::PERMISSION_RECRUITMENT_LIST_HR)->only('index');
        $this->middleware('permission:' . Acl::PERMISSION_RECRUITMENT_ADD_HR)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_RECRUITMENT_EDIT_HR)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_RECRUITMENT_DELETE_HR)->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $recruitments = $this->recruitmentRepository->getDataForDatatable($request->all());
            return RecruitmentResource::collection($recruitments);
        }
        return view('admin.recruitment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = $this->departmentRepository->all();
        $positions = $this->positionRepository->all();
        return view('admin.recruitment.create', compact('departments', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecruitmentRequest $request)
    {
        $this->recruitmentRepository->create($request->validated()) ?
            session()->flash('success', 'Thêm tuyển dụng thành công')
            :
            session()->flash('error', 'Thêm tuyển dụng không thành công');
        return to_route('admin.recruitment.index');
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
    public function edit(Recruitment $recruitment)
    {
        $departments = $this->departmentRepository->all();
        $positions = $this->positionRepository->all();
        return view('admin.recruitment.edit', compact('departments', 'positions', 'recruitment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecruitmentRequest $request, Recruitment $recruitment)
    {
        $this->recruitmentRepository->update($recruitment, $request->validated()) ?
            session()->flash('success', 'Cập nhật tuyển dụng thành công')
            :
            session()->flash('error', 'Cập nhật tuyển dụng không thành công');
        return to_route('admin.recruitment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recruitment $recruitment)
    {
        return $this->recruitmentRepository->destroy($recruitment);
    }
}
