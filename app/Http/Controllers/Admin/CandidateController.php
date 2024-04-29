<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Enums\CandidateStatus;
use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Http\Requests\Candidate\StoreCandidateRequest;
use App\Http\Resources\CandidateResource;
use App\Repositories\Candidate\CandidateRepositoryInterface;
use App\Repositories\Recruitment\RecruitmentRepositoryInterface;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function __construct(
        protected CandidateRepositoryInterface $candidateRepository,
        protected RecruitmentRepositoryInterface $recruitmentRepository,
    ) {
        $this->middleware('permission:' . Acl::PERMISSION_CANDIDATE_LIST_HR)->only('index');
        $this->middleware('permission:' . Acl::PERMISSION_CANDIDATE_ADD_HR)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_CANDIDATE_EDIT_HR)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_CANDIDATE_DELETE_HR)->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $candidates = $this->candidateRepository->getDataForDatatable($request->all());
            return CandidateResource::collection($candidates);
        }
        return view('admin.candidate.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $recruitments = $this->recruitmentRepository->all();
        $candidateStatuses = CandidateStatus::getCandidateStatuses();
        $genders = Gender::getGenders();

        return view(
            'admin.candidate.create',
            compact(
                'recruitments',
                'candidateStatuses',
                'genders',
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCandidateRequest $request)
    {
        $this->candidateRepository->create($request->validated()) ?
            session()->flash('success', 'Thêm ứng viên thành công')
            :
            session()->flash('error', 'Thêm ứng viên không thành công');
        return to_route('admin.candidate.index');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
