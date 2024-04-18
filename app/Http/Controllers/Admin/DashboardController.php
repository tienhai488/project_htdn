<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
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
}
