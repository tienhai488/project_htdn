@extends('layouts.admin')

@section('title')
    Thêm mới người dùng
@endsection

@section('style-plugins')
    <link rel="stylesheet" href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

    <link href="{{ asset('src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('src/plugins/src/filepond/filepond.min.css') }}">
    <link href="{{ asset('src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">

    <link href="{{ asset('src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/tomSelect/tom-select.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
    <style>
        .ts-wrapper {
            height: 48px !important;
        }
        .ts-wrapper .ts-control {
            font-size: 15px !important;
        }

        .ts-wrapper .ts-dropdown {
            font-size: 15px !important;
        }
    </style>
@endsection

@section('script-plugins')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    @include('includes.toast')

    <script src="{{ asset('src/plugins/src/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>

    <script src="{{ asset('src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('src/plugins/src/flatpickr/custom-flatpickr.js') }}"></script>

    <script src="{{ asset('src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
    <script src="{{ asset('src/plugins/src/tomSelect/custom-tom-select.js') }}"></script>
@endsection

@section('content')
    <div class="layout-top-spacing col-12">
        <a href="{{ route('admin.user.index') }}" class="btn btn-default _effect--ripple waves-effect waves-light">
            Trở lại
        </a>
    </div>
    <div class="row layout-top-spacing ">
        <div id="supplier-management" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Thêm mới người dùng</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area" style="padding: 20px !important;">
                    <div class="col-lg-12">
                        <form id="general-settings" method="POST" action="{{ route('admin.user.store') }}">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="descriptilon">Ảnh đại diện <strong class="text-danger">*</strong></label>
                                    <input
                                        type="file"
                                        class="filepond file-upload"
                                        id="thumbnail"
                                        name="thumbnail"
                                    >
                                    @error('thumbnail')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <x-form.input
                                        :id="'name'"
                                        :name="'name'"
                                        :label="'Tên'"
                                        :placeholder="'Tên'"
                                        :value="old('name')"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.input
                                        :id="'email'"
                                        :name="'email'"
                                        :label="'Email'"
                                        :placeholder="'Email'"
                                        :value="old('email')"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.input
                                        :id="'password'"
                                        :name="'password'"
                                        :label="'Mật khẩu'"
                                        :placeholder="'Mật khẩu'"
                                        :type="'password'"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.select-enum
                                        :id="'status'"
                                        :name="'status'"
                                        :label="'Trạng thái tài khoản'"
                                        :value="old('status')"
                                        :data-select="$userStatuses"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.input
                                        :id="'password_confirmation'"
                                        :name="'password_confirmation'"
                                        :label="'Xác nhận lại mật khẩu'"
                                        :placeholder="'Xác nhận lại mật khẩu'"
                                        :type="'password'"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <label for="role">
                                        Vai trò của tài khoản <strong class="text-danger">*</strong>
                                    </label>
                                    <select
                                        id="roles"
                                        name="roles[]"
                                        multiple
                                        placeholder="Lựa chọn..."
                                        autocomplete="off"
                                    >
                                    @foreach ($roles as $role)
                                    <option
                                        value="{{ $role->id }}"
                                        @selected(in_array($role->id, (old('roles') ?? [])))
                                    >
                                        {{ $role->name }}
                                    </option>
                                    @endforeach
                                    </select>
                                    @error('roles')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="position_id">Vị trí</label>
                                    <input
                                        class="form-control text-dark"
                                        value="N/A"
                                        readonly
                                    >
                                </div>

                                <div class="col-md-6">
                                    <x-form.select
                                        :id="'department_id'"
                                        :name="'department_id'"
                                        :label="'Phòng ban'"
                                        :value="old('department_id')"
                                        :data-select="$departments"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.input
                                        :id="'phone_number'"
                                        :name="'phone_number'"
                                        :label="'Số điện thoại'"
                                        :placeholder="'Số điện thoại'"
                                        :value="old('phone_number')"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.select-enum
                                        :id="'gender'"
                                        :name="'gender'"
                                        :label="'Giới tính'"
                                        :value="old('gender')"
                                        :data-select="$genders"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.input
                                        :id="'citizen_id'"
                                        :name="'citizen_id'"
                                        :label="'CMND/CCCD'"
                                        :placeholder="'CMND/CCCD'"
                                        :value="old('citizen_id')"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.input
                                        :id="'birthday'"
                                        :name="'birthday'"
                                        :label="'Ngày sinh'"
                                        :placeholder="'Ngày sinh'"
                                        :value="old('birthday')"
                                    />
                                </div>
                            </div>

                            <x-form.textarea
                                :id="'address'"
                                :name="'address'"
                                :label="'Địa chỉ'"
                                :placeholder="'Địa chỉ'"
                                :value="old('address')"
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
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginImageTransform,
            FilePondPluginFileEncode,
            FilePondPluginFileValidateType
        );

        const thumbnail = FilePond.create(
            document.querySelector('#thumbnail'), {
                acceptedFileTypes: ['image/*'],
                labelFileTypeNotAllowed: 'sai định dạng',
                fileValidateTypeLabelExpectedTypes: 'phải là hình ảnh',
                maxFileSize: '5MB',
                labelMaxFileSizeExceeded: 'Tệp quá lớn',
                labelMaxFileSize: 'Kích thước ảnh tối đa 5MB',
                labelIdle: 'Kéo & thả hoặc <span class="filepond--label-action">chọn từ thiết bị</span>',
            }
        );

        let dt = flatpickr(document.getElementById('birthday'));

        let tomSelectRoles = new TomSelect("#roles");
    </script>
@endsection
