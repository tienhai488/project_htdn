@extends('layouts.admin')

@section('title')
    Thêm mới hóa đơn nhập
@endsection

@section('style-plugins')
    <link rel="stylesheet" href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

    <link href="{{ asset('src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/tomSelect/tom-select.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
@endsection

@section('script-plugins')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    @include('includes.toast')

    <script src="{{ asset('src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
    <script src="{{ asset('src/plugins/src/tomSelect/custom-tom-select.js') }}"></script>
@endsection

@section('content')
    <div class="layout-top-spacing col-12">
        <a href="{{ route('admin.purchase_order.index') }}" class="btn btn-default _effect--ripple waves-effect waves-light">
            Trở lại
        </a>
    </div>
    <div class="row layout-top-spacing ">
        <div id="supplier-management" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Thêm mới hóa đơn nhập</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area" style="padding: 20px !important;">
                    <div class="col-lg-12">
                        <form id="general-settings" method="POST" action="{{ route('admin.purchase_order.store') }}">
                            @csrf
                            <x-form.select
                                :id="'supplier_id'"
                                :name="'supplier_id'"
                                :label="'Nhà cung cấp'"
                                :value="old('supplier_id')"
                                :data-select="$suppliers"
                            />

                            <x-form.textarea
                                :id="'note'"
                                :name="'note'"
                                :label="'Ghi chú'"
                                :placeholder="'Ghi chú'"
                                :value="old('note')"
                            />

                            <div class="form-group mb-4">
                                <label for="note">Sản phẩm được nhập <strong class="text-danger">*</strong>
                                </label>
                                <select class="form-control" id="select-products" multiple placeholder="Chọn một sản phẩm..." autocomplete="off">
                                    <option value="">Chọn một sản phẩm...</option>
                                    @foreach ($products as $product)
                                        <option
                                            @selected(false) value="{{ $product->id }}"
                                        >
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="product-group">
                            </div>

                            <button type="submit" class="btn btn-primary _effect--ripple waves-effect waves-light">
                                Hoàn tất
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let tomSelectProducts = new TomSelect("#select-products");

        let productItem = `
            <div class="row mb-4 product-item">
                <input type="hidden" name="product_id[]" class="product_id">
                <div class="col-md-9">
                    <input
                        type="text"
                        name="product_name[]"
                        class="form-control text-dark product_name"
                        placeholder="Tên sản phẩm"
                        readonly
                    >
                </div>
                <div class="col-md-3">
                    <input
                        type="number"
                        min="1"
                        required
                        name="product_quantity[]"
                        class="form-control
                        product_quantity"
                        placeholder="Số lượng"
                    >
                </div>
            </div>
        `;

        function debounce(func, timeout = 300){
                let timer;
                return (...args) => {
                    clearTimeout(timer);
                    timer = setTimeout(() => { func.apply(this, args); }, timeout);
                };
            }

        function handleChangeTomSelect(){
            let selectedValues = tomSelectProducts.getValue();
            let options = tomSelectProducts.options;
            let productGroup = document.querySelector(".product-group");
            let productItems = productGroup.querySelectorAll(".product-item");

            if(productItems.length){
                productItems.forEach(productItem => {
                    let productId = productItem.getAttribute("data-product-id");
                    if(!selectedValues.includes(productId)){
                        productItem.remove();
                    }
                    else {
                        selectedValues = selectedValues.filter(value => value != productId);
                    }
                });
            }

            if(selectedValues.length){
                selectedValues.forEach((value, index) => {
                    let productItemNode = new DOMParser()
                    .parseFromString(productItem, "text/html")
                    .querySelector(".product-item");
                    let productName = options[value].text.trim();

                    productItemNode.setAttribute("data-product-id", value);
                    productItemNode.querySelector(".product_name").value = productName;
                    productItemNode.querySelector(".product_id").value = value;

                    if({!! json_encode(old('product_quantity')) !!}){
                        let values = {!! json_encode(old('product_quantity')) !!};
                        productItemNode.querySelector(".product_quantity").value = values[index];
                    }

                    productGroup.appendChild(productItemNode);
                });
            }
        }

        const processChange = debounce(() => handleChangeTomSelect());

        tomSelectProducts.on("change", function() {
            processChange();
        });

        if({!! json_encode(old('product_id')) !!}){
            let values = {!! json_encode(old('product_id')) !!};
            values.forEach(value => tomSelectProducts.addItem(value));
        }
    </script>
@endsection
