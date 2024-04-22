<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Salary\StoreSalaryRequest;
use App\Http\Resources\UserSalaryResource;
use App\Models\Salary;
use App\Repositories\Salary\SalaryRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected SalaryRepositoryInterface $salaryRepository,
    ) {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->userRepository->getDataForSalaryDatatable($request->all());
            return UserSalaryResource::collection($users);
        }
        return view('admin.salary.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalaryRequest $request)
    {
        if ($request->ajax()) {
            return true;
        }

        $this->salaryRepository->create($request->all()) ?
            session()->flash('success', 'Thêm mới lương thành công!')
            :
            session()->flash('error', 'Thêm mới lương thất bại!');

        return back();
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
    public function update(Request $request, Salary $salary)
    {
        $this->salaryRepository->updateSalaryStatus($salary) ?
            session()->flash('success', 'Cập nhật trạng thái lương thành công!')
            :
            session()->flash('error', 'Cập nhật trạng thái lương thất bại!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
