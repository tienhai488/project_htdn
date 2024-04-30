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
                                <div class="form-group mb-4 col-md-6">
                                    <label for="recruitment_id">Đợt tuyển dụng <strong class="text-danger">*</strong>
                                    </label>
                                    <select class="form-select" id="recruitment_id" name="recruitment_id">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($recruitments as $recruitment)
                                            <option
                                                @selected(old('recruitment_id') == $recruitment->id)
                                                value="{{ $recruitment->id }}"
                                            >
                                                {{ $recruitment->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('recruitment_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="name">Tên <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Tên"
                                        value="{{ old('name') }}"
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
                                        value="{{ old('email') }}"
                                        spellcheck="false"
                                    >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
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
                                        value="{{ old('phone_number') }}"
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
                                    <label for="birthday">Ngày sinh <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="birthday"
                                        id="birthday"
                                        class="form-control @error('birthday') is-invalid @enderror"
                                        placeholder="Ngày sinh"
                                        value="{{ old('birthday') }}"
                                        spellcheck="false"
                                    >
                                    @error('birthday')
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
                                                @selected(old('gender') != '' && old('gender') == $gender['case']->value)
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
                                    <label for="desired_salary">Mức lương mong muốn <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="desired_salary"
                                        id="desired_salary"
                                        class="form-control @error('desired_salary') is-invalid @enderror"
                                        placeholder="Mức lương mong muốn"
                                        value="{{ old('desired_salary') }}"
                                        spellcheck="false"
                                    >
                                    @error('desired_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="status">Trạng thái ứng viên <strong class="text-danger">*</strong>
                                    </label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($candidateStatuses as $status)
                                            <option
                                                @selected(old('status') != '' && old('status') == $status['case']->value)
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

                            <div class="form-group mb-4">
                                <label for="note">Ghi chú <strong class="text-danger">*</strong>
                                </label>
                                <textarea
                                    name="note"
                                    id="note"
                                    class="form-control @error('note') is-invalid @enderror"
                                    id="note"
                                    rows="3"
                                    placeholder="Ghi chú"
                                    spellcheck="false"
                                    @error('note') is-invalid @enderror>{{ old('note') }}</textarea>
                                @error('note')
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
