<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\StoreProductCategoryRequest;
use App\Http\Requests\ProductCategory\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __construct(
        protected ProductCategoryRepositoryInterface $productCategoryRepository,
    ) {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->productCategoryRepository->getDataForDatatable($request->all());
        }
        return view('admin.product_category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $this->productCategoryRepository->create($request->except('_token')) ?
            session()->flash('success', 'Thêm danh mục sản phẩm thành công')
            :
            session()->flash('error', 'Thêm danh mục sản phẩm không thành công');
        return to_route('admin.product_category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product_category.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $this->productCategoryRepository->update($productCategory, $request->only('name')) ?
            session()->flash('success', 'Cập nhật danh mục sản phẩm thành công')
            :
            session()->flash('error', 'Cập nhật danh mục sản phẩm không thành công');
        return to_route('admin.product_category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        return $this->productCategoryRepository->destroy($productCategory);
    }
}
