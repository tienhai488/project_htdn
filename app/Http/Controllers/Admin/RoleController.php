<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(
        protected RoleRepositoryInterface $roleRepository,
        protected PermissionRepositoryInterface $permissionRepository,
    ) {
        $this->middleware('permission:' . Acl::PERMISSION_ROLE_LIST_HR)->only('index');
        $this->middleware('permission:' . Acl::PERMISSION_ROLE_ADD_HR)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_ROLE_EDIT_HR)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_ROLE_DELETE_HR)->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->roleRepository->getDataForDatatable($request->all());
        }
        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permissionRepository->all();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roleRepository->create($request->validated()) ?
            session()->flash('success', 'Thêm vai trò thành công')
            :
            session()->flash('error', 'Thêm vai trò không thành công');
        return to_route('admin.role.index');
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
    public function edit(Role $role)
    {
        $permissions = $this->permissionRepository->all();
        $role->load('permissions');
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->roleRepository->update($role, $request->validated()) ?
            session()->flash('success', 'Cập nhật vai trò thành công')
            :
            session()->flash('error', 'Cập nhật vai trò không thành công');
        return to_route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        return $this->roleRepository->destroy($role);
    }
}