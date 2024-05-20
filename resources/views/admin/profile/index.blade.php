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
                                                                    <div class="col-md-6">
                                                                        <x-form.input
                                                                            :id="'name'"
                                                                            :name="'name'"
                                                                            :label="'Tên'"
                                                                            :placeholder="'Tên'"
                                                                            :value="old('name') ?? $user->name"
                                                                        />
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <x-form.input
                                                                            :id="'email'"
                                                                            :name="'email'"
                                                                            :label="'Email'"
                                                                            :placeholder="'Email'"
                                                                            :value="old('email') ?? $user->email"
                                                                        />
                                                                    </div>

                                                                    <div class="form-group mb-4 col-md-6">
                                                                        <label for="position_id">Vị trí</label>
                                                                        <input
                                                                            id="position_id"
                                                                            class="form-control text-dark"
                                                                            value="{{ $approvedSalary ?
                                                                            $approvedSalary->position->name
                                                                            :
                                                                            'N/A'
                                                                            }}"
                                                                            readonly
                                                                        >
                                                                    </div>

                                                                    <div class="form-group mb-4 col-md-6">
                                                                        <label for="department_id">Phòng ban
                                                                        </label>
                                                                        <input
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

                                                                    <div class="col-md-6">
                                                                        <x-form.input
                                                                            :id="'phone_number'"
                                                                            :name="'phone_number'"
                                                                            :label="'Số điện thoại'"
                                                                            :placeholder="'Số điện thoại'"
                                                                            :value="old('phone_number') ?? $userProfile['phone_number']"
                                                                        />
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <x-form.select-enum
                                                                            :id="'gender'"
                                                                            :name="'gender'"
                                                                            :label="'Giới tính'"
                                                                            :value="old('gender') ?? $userProfile['gender']->value"
                                                                            :data-select="$genders"
                                                                        />
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <x-form.input
                                                                            :id="'citizen_id'"
                                                                            :name="'citizen_id'"
                                                                            :label="'CMND/CCCD'"
                                                                            :placeholder="'CMND/CCCD'"
                                                                            :value="old('citizen_id') ?? $userProfile['citizen_id']"
                                                                        />
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <x-form.input
                                                                            :id="'birthday'"
                                                                            :name="'birthday'"
                                                                            :label="'Ngày sinh'"
                                                                            :placeholder="'Ngày sinh'"
                                                                            :value="old('birthday') ?? $userProfile['birthday']"
                                                                        />
                                                                    </div>

                                                                    <x-form.textarea
                                                                        :id="'address'"
                                                                        :name="'address'"
                                                                        :label="'Địa chỉ'"
                                                                        :placeholder="'Địa chỉ'"
                                                                        :value="old('address') ?? $userProfile['address']"
                                                                    />

                                                                    <div class="col-md-12 mt-1">
                                                                        <div class="form-group">
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
                                                            <x-form.input
                                                                :id="'current_password'"
                                                                :name="'current_password'"
                                                                :label="'Mật khẩu hiện tại'"
                                                                :placeholder="'Mật khẩu hiện tại'"
                                                                :type="'password'"
                                                            />

                                                            <x-form.input
                                                                :id="'password'"
                                                                :name="'password'"
                                                                :label="'Mật khẩu mới'"
                                                                :placeholder="'Mật khẩu mới'"
                                                                :type="'password'"
                                                            />

                                                            <x-form.input
                                                                :id="'password_confirmation'"
                                                                :name="'password_confirmation'"
                                                                :label="'Xác nhận lại mật khẩu'"
                                                                :placeholder="'Xác nhận lại mật khẩu'"
                                                                :type="'password'"
                                                            />

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
