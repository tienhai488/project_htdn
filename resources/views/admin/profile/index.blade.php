@extends('layouts.admin')

@section('title')
    Thông tin cá nhân
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

    <link href="{{ asset('src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('src/assets/css/dark/users/account-setting.css') }}" rel="stylesheet" type="text/css" />

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

    <script src="{{ asset('src/assets/js/users/account-settings.js') }}"></script>

    <script src="{{ asset('src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('src/plugins/src/flatpickr/custom-flatpickr.js') }}"></script>
@endsection

@section('content')
    <div class="row layout-top-spacing ">
        <div id="supplier-management" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Thông tin cá nhân</h4>
                        </div>
                    </div>
                </div>

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <ul class="nav nav-pills" id="animateLine" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if (!session('tab_password')) active @endif" id="animated-underline-home-tab" data-bs-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="@if (!session('tab_password')) true @else false @endif">
                                            <i data-feather="user"></i>
                                            Thông tin
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation" id="">
                                        <button class="nav-link @if (session('tab_password')) active @endif" id="animated-underline--tab" data-bs-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="@if (session('tab_password')) true @else false @endif" tabindex="-1">
                                            <i data-feather="lock"></i>
                                            Mật khẩu
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content" id="animateLineContent-4">
                            <div class="tab-pane-profile tab-pane fade active show" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <form class="section general-info" action="{{ route('admin.profile.update', $user) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="info">
                                                <div class="row">
                                                    <div class="col-lg-11 mx-auto">
                                                        <div class="row">
                                                            <div class="col-xl-2 col-lg-12 col-md-4">
                                                                <input type="file" class="filepond file-upload" id="findpond" name="findpond">
                                                            </div>
                                                            <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
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
                                                                        <label for="position_id">Vị trí</label>
                                                                        <input
                                                                            type="text"
                                                                            id="position_id"
                                                                            class="form-control text-dark"
                                                                            value="N/A"
                                                                            readonly
                                                                        >
                                                                    </div>

                                                                    <div class="form-group mb-4 col-md-6">
                                                                        <label for="department_id">Phòng ban
                                                                        </label>
                                                                        <input
                                                                            type="text"
                                                                            id="position_id"
                                                                            class="form-control text-dark"
                                                                            value="{{
                                                                            $userProfile['department_id'] != '' ?
                                                                            $userProfile->department->name
                                                                            :
                                                                            'N/A'
                                                                            }}"
                                                                            readonly
                                                                        >
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

                                                                    <div class="col-md-12 mt-1">
                                                                        <div class="form-group text-end">
                                                                            <button class="btn btn-secondary _effect--ripple waves-effect waves-light">Hoàn tất</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane-password tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <form class="section general-info" action="{{ route('admin.profile.update_password') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="info">
                                                <div class="row">
                                                    <div class="col-lg-6 mx-auto">
                                                        <div class="row">
                                                            <div class="form-group mb-4">
                                                                <label for="current_password">Mật khẩu hiện tại <strong class="text-danger">*</strong>
                                                                </label>
                                                                <input
                                                                    type="password"
                                                                    name="current_password"
                                                                    id="current_password"
                                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                                    placeholder="Mật khẩu hiện tại"
                                                                >
                                                                @error('current_password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group mb-4">
                                                                <label for="password">Mật khẩu mới <strong class="text-danger">*</strong>
                                                                </label>
                                                                <input
                                                                    type="password"
                                                                    name="password"
                                                                    id="password"
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    placeholder="Mật khẩu mới"
                                                                >
                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group mb-4">
                                                                <label for="password_confirmation">Xác nhận lại mật khẩu <strong class="text-danger">*</strong>
                                                                </label>
                                                                <input
                                                                    type="password"
                                                                    name="password_confirmation"
                                                                    id="password_confirmation"
                                                                    class="form-control"
                                                                    placeholder="Xác nhận lại mật khẩu"
                                                                >
                                                            </div>

                                                            <div class="form-group">
                                                                <button class="btn btn-primary _effect--ripple waves-effect waves-light">
                                                                    Hoàn tất
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    const thumbnail = FilePond.create(document.querySelector('#findpond'), {
        acceptedFileTypes: ['image/*'],
        labelFileTypeNotAllowed: 'sai định dạng',
        fileValidateTypeLabelExpectedTypes: 'phải là hình ảnh',
        maxFileSize: '5MB',
        labelMaxFileSizeExceeded: 'Tệp quá lớn',
        labelMaxFileSize: 'Kích thước ảnh tối đa 5MB',
        labelIdle: 'Kéo & thả hoặc <span class="filepond--label-action">chọn từ thiết bị</span>',
        imagePreviewHeight: 170,
        imageCropAspectRatio: '1:1',
        imageResizeTargetWidth: 200,
        imageResizeTargetHeight: 200,
        stylePanelLayout: 'compact circle',
        styleLoadIndicatorPosition: 'center bottom',
        styleProgressIndicatorPosition: 'right bottom',
        styleButtonRemoveItemPosition: 'left bottom',
        styleButtonProcessItemPosition: 'right bottom',
    });

    let tabPaneProfile = document.querySelector('.tab-pane-profile');
    let tabPanePassword = document.querySelector('.tab-pane-password');
    let checkLoaded = false;

    @if (session('tab_password'))
        tabPaneProfile.classList.remove('active', 'show');
        tabPanePassword.classList.add('active', 'show');

        document.querySelector('#animated-underline-home-tab').onclick = () => {
            tabPaneProfile.classList.add('active', 'show');
            tabPanePassword.classList.remove('active', 'show');

            if(!checkLoaded){
                thumbnail.addFile(`{{ $user->thumbnail }}`);
                checkLoaded = true;
            }
        }
    @endif

    thumbnail.addFile(`{{ $user->thumbnail }}`);

    let dt = flatpickr(document.getElementById('birthday'));
</script>
@endsection
