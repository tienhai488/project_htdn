<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Positon\StorePositionRequest;
use App\Http\Requests\Positon\UpdatePositionRequest;
use App\Models\Position;
use App\Repositories\Position\PositionRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct(
        protected PositionRepositoryInterface $positionRepository,
        protected UserRepositoryInterface $userRepository,
    ) {
        $this->middleware('permission:' . Acl::PERMISSION_POSITION_LIST_HR)->only('index');
        $this->middleware('permission:' . Acl::PERMISSION_POSITION_ADD_HR)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_POSITION_EDIT_HR)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_POSITION_DELETE_HR)->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $countList = $this->userRepository->getCountUsersInPosition();
        if ($request->ajax()) {
            return $this->positionRepository->getDataForDatatable($request->all());
        }
        return view('admin.position.index', compact('countList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
        $this->positionRepository->create($request->except('_token')) ?
            session()->flash('success', 'Thêm vị trí thành công')
            :
            session()->flash('error', 'Thêm vị trí không thành công');
        return to_route('admin.position.index');
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
    public function edit(Position $position)
    {
        return view('admin.position.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $this->positionRepository->update($position, $request->only('name')) ?
            session()->flash('success', 'Cập nhật vị trí thành công')
            :
            session()->flash('error', 'Cập nhật vị trí không thành công');
        return to_route('admin.position.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        return $this->positionRepository->destroy($position);
    }
}