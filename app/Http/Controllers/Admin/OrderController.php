<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DeliveryStatus;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ShippingUnit\ShippingUnitRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected CustomerRepositoryInterface $customerRepository,
        protected ShippingUnitRepositoryInterface $shippingUnitRepository,
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
            $orders = $this->orderRepository->getDataForDatatable($request->all());
            return OrderResource::collection($orders);
        }
        return view('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = $this->customerRepository->all();
        $shippingUnits = $this->shippingUnitRepository->all();
        $paymentStatuses = PaymentStatus::getPaymentStatuses();
        $deliveryStatuses = DeliveryStatus::getDeliveryStatuses();
        $products = $this->productRepository->getProductListForOrder();

        return view(
            'admin.order.create',
            compact(
                'customers',
                'shippingUnits',
                'paymentStatuses',
                'deliveryStatuses',
                'products'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $this->orderRepository->create($request->except('_token')) ?
            session()->flash('success', 'Thêm hóa đơn bán thành công')
            :
            session()->flash('error', 'Thêm hóa đơn bán không thành công');
        return to_route('admin.order.index');
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
    public function edit(Order $order)
    {
        $orderProducts = $order->products()->withPivot('quantity')->get();
        $customers = $this->customerRepository->all();
        $shippingUnits = $this->shippingUnitRepository->all();
        $paymentStatuses = PaymentStatus::getPaymentStatuses();
        $deliveryStatuses = DeliveryStatus::getDeliveryStatuses();
        $products = $this->productRepository->getProductListForOrder();
        return view(
            'admin.order.edit',
            compact(
                'order',
                'orderProducts',
                'customers',
                'shippingUnits',
                'paymentStatuses',
                'deliveryStatuses',
                'products'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->orderRepository->update($order, $request->except('_token')) ?
            session()->flash('success', 'Cập nhật hóa đơn bán thành công')
            :
            session()->flash('error', 'Cập nhật hóa đơn bán không thành công');
        return to_route('admin.order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
