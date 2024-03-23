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
    {{-- sweatalert2 --}}
    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    @include('layouts.toast')
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
                            <div class="form-group mb-4">
                                <label for="name">Tên <strong class="text-danger">*</strong>
                                </label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Tên" value="{{ old('name') ?? $supplier->name }}" spellcheck="false">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="phone_number">Số điện thoại <strong class="text-danger">*</strong>
                                </label>
                                <input type="text" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                                    placeholder="Số điện thoại"
                                    value="{{ old('phone_number') ?? $supplier->phone_number }}" spellcheck="false"
                                    @error('phone_number') is-invalid @enderror>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="email">Email <strong class="text-danger">*</strong>
                                </label>
                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="Email" value="{{ old('email') ?? $supplier->email }}" spellcheck="false"
                                    @error('email') is-invalid @enderror>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="address">Địa chỉ <strong class="text-danger">*</strong>
                                </label>
                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" id="address"
                                    rows="3" placeholder="Địa chỉ" spellcheck="false" @error('address') is-invalid @enderror>{{ old('address') ?? $supplier->address }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
@endsection
