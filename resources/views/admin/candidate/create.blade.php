@extends('layouts.admin')

@section('title')
    Thêm mới ứng viên
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
        <a href="{{ route('admin.candidate.index') }}" class="btn btn-default _effect--ripple waves-effect waves-light">
            Trở lại
        </a>
    </div>
    <div class="row layout-top-spacing ">
        <div id="supplier-management" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Thêm mới ứng viên</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area" style="padding: 20px !important;">
                    <div class="col-lg-12">
                        <form id="general-settings" method="POST" action="{{ route('admin.candidate.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-form.select
                                        :id="'recruitment_id'"
                                        :name="'recruitment_id'"
                                        :label="'Đợt tuyển dụng'"
                                        :value="old('recruitment_id')"
                                        :data-select="$recruitments"
                                        :field-name="'title'"
                                    />
                                </div>

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
                                        :id="'phone_number'"
                                        :name="'phone_number'"
                                        :label="'Số điện thoại'"
                                        :placeholder="'Số điện thoại'"
                                        :value="old('phone_number')"
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
                                        :id="'desired_salary'"
                                        :name="'desired_salary'"
                                        :label="'Mức lương mong muốn'"
                                        :placeholder="'Mức lương mong muốn'"
                                        :value="old('desired_salary')"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.select-enum
                                        :id="'status'"
                                        :name="'status'"
                                        :label="'Trạng thái ứng viên'"
                                        :value="old('status')"
                                        :data-select="$candidateStatuses"
                                    />
                                </div>

                                <div class="mb-4 col-md-12">
                                    <label>CV (PDF) <strong class="text-danger">*</strong></label>
                                    <input
                                        type="file"
                                        class="filepond file-upload"
                                        id="cv"
                                        name="cv"
                                    >
                                    @error('cv')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <x-form.textarea
                                :id="'note'"
                                :name="'note'"
                                :label="'Ghi chú'"
                                :placeholder="'Ghi chú'"
                                :value="old('note')"
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

        const cv = FilePond.create(
            document.querySelector('#cv'), {
                acceptedFileTypes: ['application/pdf'],
                labelFileTypeNotAllowed: 'sai định dạng',
                fileValidateTypeLabelExpectedTypes: 'phải là pdf',
                maxFileSize: '5MB',
                labelMaxFileSizeExceeded: 'Tệp quá lớn',
                labelMaxFileSize: 'Kích thước ảnh tối đa 5MB',
                labelIdle: 'Kéo & thả hoặc <span class="filepond--label-action">chọn từ thiết bị</span>',
            }
        );

        let dt = flatpickr(document.getElementById('birthday'));
    </script>
@endsection
