<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct(
        protected SupplierRepositoryInterface $supplierRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->supplierRepository->getDataForDatatable();
        }
        return view('admin.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        $this->supplierRepository->create($request->except('_token')) ?
            session()->flash('success', 'Thêm nhà cung cấp thành công')
            :
            session()->flash('error', 'Thêm nhà cung cấp không thành công');
        return to_route('admin.supplier.index');
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
