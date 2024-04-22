<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderStatisticResource;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use App\Repositories\PurchaseOrder\PurchaseOrderRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected ProductCategoryRepositoryInterface $productCategoryRepository,
        protected PurchaseOrderRepositoryInterface $purchaseOrderRepository,
        protected ProductRepositoryInterface $productRepository,
    ) {
        //
    }
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function orderStatistic(Request $request)
    {
        if ($request->ajax()) {
            return $this->orderRepository->getDataForOrderStatistic($request->start, $request->end, $request->filter, $request->range);
        }

        return view('admin.dashboard.order_statistic');
    }

    public function purchaseOrderStatistic(Request $request)
    {
        $productCategories = $this->productCategoryRepository->all();
        if ($request->ajax()) {
            $products = $this->productRepository->getDataForDatatable($request->all());
            return PurchaseOrderStatisticResource::collection($products);
        }
        return view('admin.dashboard.purchase_order_statistic', compact('productCategories'));
    }
}
