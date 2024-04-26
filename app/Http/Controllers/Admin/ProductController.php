<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
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
            $products = $this->productRepository->getDataForDatatable($request->all());
            return ProductResource::collection($products);
        }
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = $this->productCategoryRepository->all();
        return view('admin.product.create', compact(
            'productCategories',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->productRepository->create($request->except('_token')) ?
            session()->flash('success', 'Thêm sản phẩm thành công')
            :
            session()->flash('error', 'Thêm sản phẩm không thành công');
        return to_route('admin.product.index');
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
    public function edit(Product $product)
    {
        $productCategories = $this->productCategoryRepository->all();
        return view('admin.product.edit', compact(
            'productCategories',
            'product',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productRepository->update($product, $request->except('_token')) ?
            session()->flash('success', 'Cập nhật sản phẩm thành công')
            :
            session()->flash('error', 'Cập nhật sản phẩm không thành công');
        return to_route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return $this->productRepository->destroy($product);
    }
}
