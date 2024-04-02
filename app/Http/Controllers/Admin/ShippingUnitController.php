<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingUnit\StoreShippingUnitRequest;
use App\Http\Requests\ShippingUnit\UpdateShippingUnitRequest;
use App\Models\ShippingUnit;
use App\Repositories\ShippingUnit\ShippingUnitRepositoryInterface;
use Illuminate\Http\Request;

class ShippingUnitController extends Controller
{
    public function __construct(
        protected ShippingUnitRepositoryInterface $shippingUnitRepository,
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->shippingUnitRepository->getDataForDatatable($request->all());
        }
        return view('admin.shipping_unit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping_unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingUnitRequest $request)
    {
        $this->shippingUnitRepository->create($request->except('_token')) ?
            session()->flash('success', 'Thêm đơn vị vận chuyển thành công')
            :
            session()->flash('error', 'Thêm đơn vị vận chuyển không thành công');
        return to_route('admin.shipping-unit.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingUnit $shippingUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingUnit $shippingUnit)
    {
        return view('admin.shipping_unit.edit', compact('shippingUnit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingUnitRequest $request, ShippingUnit $shippingUnit)
    {
        $this->shippingUnitRepository->update($shippingUnit, $request->only('name')) ?
            session()->flash('success', 'Cập nhật đơn vị vận chuyển thành công')
            :
            session()->flash('error', 'Cập nhật đơn vị vận chuyển không thành công');
        return to_route('admin.shipping-unit.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingUnit $shippingUnit)
    {
        return $this->shippingUnitRepository->destroy($shippingUnit);
    }
}
