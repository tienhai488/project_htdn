<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use App\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository
    ) {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->customerRepository->getDataForDatatable($request->all());
        }
        return view('admin.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $this->customerRepository->create($request->except('_token')) ?
            session()->flash('success', 'Thêm khách hàng thành công')
            :
            session()->flash('error', 'Thêm khách hàng không thành công');
        return to_route('admin.customer.index');
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
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->customerRepository->update($customer, $request->except(['_token', '_method'])) ?
            session()->flash('success', 'Cập nhật khách hàng thành công')
            :
            session()->flash('error', 'Cập nhật khách hàng không thành công');
        return to_route('admin.customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        // return $this->customerRepository->destroy($customer);
    }
}
