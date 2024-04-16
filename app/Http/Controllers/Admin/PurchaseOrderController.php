<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOrder\StorePurchaseOrderRequest;
use App\Http\Requests\PurchaseOrder\UpdatePurchaseOrderRequest;
use App\Http\Resources\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\PurchaseOrder\PurchaseOrderRepositoryInterface;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function __construct(
        protected PurchaseOrderRepositoryInterface $purchaseOrderRepository,
        protected SupplierRepositoryInterface $supplierRepository,
        protected ProductRepositoryInterface $productRepository,
    ) {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $purchaseOrders = $this->purchaseOrderRepository->getDataForDatatable($request->all());
            return PurchaseOrderResource::collection($purchaseOrders);
        }
        return view('admin.purchase_order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = $this->supplierRepository->all();
        $products = $this->productRepository->all();
        return view('admin.purchase_order.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseOrderRequest $request)
    {
        $this->purchaseOrderRepository->create($request->except('_token')) ?
            session()->flash('success', 'Thêm hóa đơn nhập thành công')
            :
            session()->flash('error', 'Thêm hóa đơn nhập không thành công');
        return to_route('admin.purchase_order.index');
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
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $suppliers = $this->supplierRepository->all();
        $products = $this->productRepository->all();
        $purchaseOrderProducts = $purchaseOrder->products()->withPivot('quantity')->get();
        return view(
            'admin.purchase_order.edit',
            compact(
                'suppliers',
                'products',
                'purchaseOrder',
                'purchaseOrderProducts'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        $this->purchaseOrderRepository->update($purchaseOrder, $request->except('_token')) ?
            session()->flash('success', 'Cập nhật hóa đơn nhập thành công')
            :
            session()->flash('error', 'Cập nhật hóa đơn nhập không thành công');
        return to_route('admin.purchase_order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
