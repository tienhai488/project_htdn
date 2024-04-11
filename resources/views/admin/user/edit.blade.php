@extends('layouts.admin')

@section('title')
    Cập nhật người dùng
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
@endsection

@section('script-plugins')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- sweatalert2 --}}
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
                            <h4>Cập nhật người dùng</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area" style="padding: 20px !important;">
                    <div class="col-lg-12">
                        <form id="general-settings" method="POST" action="{{ route('admin.user.update', $user) }}">
                            @csrf
                            @method('PUT')
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
                                <div class="form-group mb-4 col-md-6">
                                    <label for="name">Tên <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Tên"
                                        value="{{ old('name') ?? $user->name }}"
                                        spellcheck="false"
                                    >
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="email">Email <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="email"
                                        id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email"
                                        value="{{ old('email') ?? $user->email }}"
                                        spellcheck="false"
                                    >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="password">Mật khẩu (Nếu không thay đổi thì để trống)
                                    </label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Mật khẩu"
                                    >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="status">Trạng thái tài khoản <strong class="text-danger">*</strong>
                                    </label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($userStatuses as $status)
                                            <option
                                                @selected(
                                                    old('status') != '' ?
                                                    old('status') == $status['case']->value
                                                    :
                                                    $user->status == $status['case']
                                                )
                                                value="{{ $status['case']->value }}"
                                            >
                                                {{ $status['description'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="password_confirmation">Xác nhận lại mật khẩu (Nếu không thay đổi thì để trống)
                                    </label>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        class="form-control"
                                        placeholder="Xác nhận lại mật khẩu"
                                    >
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="role">Vai trò của tài khoản <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        id="role"
                                        class="form-control"
                                        placeholder="Vai trò của tài khoản"
                                    >
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="position_id">Vị trí <strong class="text-danger">*</strong>
                                    </label>
                                    <select class="form-select" id="position_id" name="position_id">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($positions as $position)
                                            <option
                                                @selected(
                                                    (old('position_id') ?? $userProfile['position_id']) == $position->id
                                                )
                                                value="{{ $position->id }}"
                                            >
                                                {{ $position->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('position_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="department_id">Phòng ban <strong class="text-danger">*</strong>
                                    </label>
                                    <select class="form-select" id="department_id" name="department_id">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($departments as $department)
                                            <option
                                                @selected(
                                                    (old('department_id') ?? $userProfile['department_id']) == $department->id
                                                )
                                                value="{{ $department->id }}"
                                            >
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="phone_number">Số điện thoại <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="phone_number"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number"
                                        placeholder="Số điện thoại"
                                        value="{{
                                            old('phone_number') ??
                                            $userProfile['phone_number']
                                        }}"
                                        spellcheck="false"
                                        @error('phone_number') is-invalid @enderror
                                    >
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="gender">Giới tính <strong class="text-danger">*</strong>
                                    </label>
                                    <select class="form-select" name="gender">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($genders as $gender)
                                            <option
                                                @selected(
                                                    old('gender') != '' ?
                                                    old('gender') == $gender['case']->value
                                                    :
                                                    $userProfile['gender'] == $gender['case']
                                                )
                                                value="{{ $gender['case']->value }}"
                                            >
                                                {{ $gender['description'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="citizen_id">CMND/CCCD <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="citizen_id"
                                        id="citizen_id"
                                        class="form-control @error('citizen_id') is-invalid @enderror"
                                        placeholder="CMND/CCCD"
                                        value="{{
                                            old('citizen_id') ?? $userProfile['citizen_id']
                                        }}"
                                        spellcheck="false"
                                    >
                                    @error('citizen_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="birthday">Ngày sinh <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="birthday"
                                        id="birthday"
                                        class="form-control @error('birthday') is-invalid @enderror"
                                        placeholder="Ngày sinh"
                                        value="{{ old('birthday') ?? $userProfile['birthday']}}"
                                        spellcheck="false"
                                    >
                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="address">Địa chỉ <strong class="text-danger">*</strong>
                                </label>
                                <textarea
                                    name="address"
                                    id="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    id="address"
                                    rows="3"
                                    placeholder="Địa chỉ"
                                    spellcheck="false"
                                    @error('address') is-invalid @enderror>{{ old('address') ?? $userProfile['address'] }}</textarea>
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

        @if(!empty($user->user_profile))
            thumbnail.addFile(`{{ $user->user_profile->thumbnail }}`);
        @endif

        let dt = flatpickr(document.getElementById('birthday'));
    </script>
@endsection
