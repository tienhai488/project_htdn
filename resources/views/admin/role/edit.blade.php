@extends('layouts.admin')

@section('title')
    Cập nhật vai trò
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
    @include('includes.toast')
@endsection

@section('content')
    <div class="layout-top-spacing col-12">
        <a href="{{ route('admin.role.index') }}" class="btn btn-default _effect--ripple waves-effect waves-light">
            Trở lại
        </a>
    </div>
    <div class="row layout-top-spacing ">
        <div id="supplier-management" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Cập nhật vai trò</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area" style="padding: 20px !important;">
                    <div class="col-lg-12">
                        <form id="general-settings" method="POST" action="{{ route('admin.role.update', $role) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="name">Tên <strong class="text-danger">*</strong>
                                </label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Tên" value="{{ old('name') ?? $role->name }}" spellcheck="false">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="name">Quyền truy cập <strong class="text-danger">*</strong>
                                </label>
                                <div class="form-check form-check-primary">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="form-check-all"
                                        value="{{ old('name') }}"
                                    >
                                    <label class="form-check-label" for="form-check-all">
                                        <b>Chọn tất cả</b>
                                    </label>
                                </div>
                                @foreach ($permissions as $permission)
                                <div class="form-check form-check-primary form-check-inline col-md-2">
                                    <div class="d-flex align-items-start" style="height: 50px;">
                                        <input
                                            style="width: 17px; height: 17px;"
                                            class="form-check-input"
                                            type="checkbox"
                                            id="form-check-default-checked-{{ $permission->name }}"
                                            name="permissions[]"
                                            value="{{ $permission->id }}"
                                            @checked(in_array($permission->id, (old('permissions') ?? $rolePermissions)))
                                        >
                                        <label class="form-check-label ms-1" for="form-check-default-checked-{{ $permission->name }}">
                                            {{ Str::title($permission->name) }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                                @error('permissions')
                                    <br>
                                    <span class="text-danger" role="alert">
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
<script>
    let checkAll = document.getElementById('form-check-all');

    checkAll.onchange = () => {
        let checkboxs = document.querySelectorAll('[name="permissions[]"]');
        if(checkAll.checked){
            checkboxs.forEach(item => item.checked = checkAll.checked)
        }
        else{
            checkboxs.forEach(item => item.checked = checkAll.checked)
        }
    }
</script>
@endsection
