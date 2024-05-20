@extends('layouts.admin')

@section('title')
    Cập nhật nhà cung cấp
@endsection

@section('style-plugins')
    <link rel="stylesheet" href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

    <link href="{{ asset('src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script-plugins')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    @include('includes.toast')
@endsection

@section('content')
    <div class="layout-top-spacing col-12">
        <a href="{{ route('admin.supplier.index') }}" class="btn btn-default _effect--ripple waves-effect waves-light">
            Trở lại
        </a>
    </div>
    <div class="row layout-top-spacing ">
        <div id="supplier-management" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Cập nhật nhà cung cấp</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area" style="padding: 20px !important;">
                    <div class="col-lg-12">
                        <form id="general-settings" method="POST" action="{{ route('admin.supplier.update', $supplier) }}">
                            @csrf
                            @method('PUT')
                            <x-form.input
                                :id="'name'"
                                :name="'name'"
                                :label="'Tên'"
                                :placeholder="'Tên'"
                                :value="old('name') ?? $supplier->name"
                            />

                            <x-form.input
                                :id="'phone_number'"
                                :name="'phone_number'"
                                :label="'Số điện thoại'"
                                :placeholder="'Số điện thoại'"
                                :value="old('phone_number') ?? $supplier->phone_number"
                            />

                            <x-form.input
                                :id="'email'"
                                :name="'email'"
                                :label="'Email'"
                                :placeholder="'Email'"
                                :value="old('email') ?? $supplier->email"
                            />

                            <x-form.textarea
                                :id="'address'"
                                :name="'address'"
                                :label="'Địa chỉ'"
                                :placeholder="'Địa chỉ'"
                                :value="old('address') ?? $supplier->address"
                            />

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
@endsection
