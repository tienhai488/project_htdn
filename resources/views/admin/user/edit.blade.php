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

    <link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/light/components/timeline.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/components/timeline.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/light/components/accordions.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/components/accordions.css') }}" rel="stylesheet" type="text/css" />

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
                            <h4>Cập nhật người dùng</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area" style="padding: 20px !important;">
                    <div class="col-lg-12">
                        @if (empty($pendingSalary))
                        <div class="d-flex justify-content-end">
                            <button
                                type="button"
                                class="btn btn-primary mr-2 _effect--ripple waves-effect waves-light"
                                data-bs-toggle="modal"
                                data-bs-target="#salaryModal"
                            >
                                Thêm mới lương
                            </button>
                        </div>

                        <div class="modal fade" id="salaryModal" tabindex="-1" role="dialog" aria-labelledby="salaryModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="salaryModalLabel" style="color: #3b3f5c;">
                                            Thêm mới lương
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.salary.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body pb-2">
                                            <p class="modal-text" style="color: #515365;">
                                                Tiền lương hiện tại: {{
                                                    $approvedSalary ?
                                                    number_format($approvedSalary->amount)
                                                    :
                                                    'N/A'
                                                }}
                                            </p>

                                            <p class="modal-text" style="color: #515365;">
                                                Vị trí hiện tại: {{
                                                    $approvedSalary ?
                                                    $approvedSalary->position->name
                                                    :
                                                    'N/A'
                                                }}
                                            </p>
                                            <hr style="border-top: 1px solid #515365;">

                                            <input
                                                type="hidden"
                                                name="user_id"
                                                value="{{ $user->id }}"
                                            />

                                            <div class="form-group mb-4">
                                                <label for="salary_amount">Tiền lương <strong class="text-danger">*</strong>
                                                </label>
                                                <input
                                                    type="text"
                                                    name="salary_amount"
                                                    class="form-control"
                                                    id="salary_amount"
                                                    placeholder="Tiền lương"
                                                    spellcheck="false"
                                                >
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="salary_position_id">Vị trí <strong class="text-danger">*</strong>
                                                </label>
                                                <select class="form-select" id="salary_position_id" name="salary_position_id">
                                                    <option value="">Lựa chọn</option>
                                                    @foreach ($positions as $position)
                                                        <option
                                                            value="{{ $position->id }}"
                                                        >
                                                            {{ $position->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="salary_status">Trạng thái lương <strong class="text-danger">*</strong>
                                                </label>
                                                <select class="form-select" id="salary_status" name="salary_status">
                                                    <option value="">Lựa chọn</option>
                                                    @foreach ($salaryStatuses as $status)
                                                        <option
                                                            value="{{ $status['case'] }}"
                                                        >
                                                            {{ $status['description'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal">
                                                <i class="flaticon-cancel-12"></i>
                                                Hủy
                                            </button>

                                            <button type="submit" class="btn btn-primary btn-submit-salary">
                                                Lưu
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif

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

                                <div class="col-md-6">
                                    <x-form.input
                                        :id="'password'"
                                        :name="'password'"
                                        :label="'Mật khẩu (Nếu không thay đổi thì để trống)'"
                                        :placeholder="'Mật khẩu (Nếu không thay đổi thì để trống)'"
                                        :type="'password'"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.select-enum
                                        :id="'status'"
                                        :name="'status'"
                                        :label="'Trạng thái tài khoản'"
                                        :value="old('status') ?? $user->status->value"
                                        :data-select="$userStatuses"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-form.input
                                        :id="'password_confirmation'"
                                        :name="'password_confirmation'"
                                        :label="'Xác nhận lại mật khẩu (Nếu không thay đổi thì để trống)'"
                                        :placeholder="'Xác nhận lại mật khẩu (Nếu không thay đổi thì để trống)'"
                                        :type="'password'"
                                    />
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="role">Vai trò của tài khoản <strong class="text-danger">*</strong>
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
                                        @selected(in_array($role->id, (old('roles') ?? $userRoles)))
                                    >
                                        {{ $role->name }}
                                    </option>
                                    @endforeach
                                    </select>
                                    @error('roles')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="position_id">
                                        Vị trí
                                    </label>
                                    <input
                                        value="{{
                                            $approvedSalary ?
                                            $approvedSalary->position->name
                                            :
                                            'N/A'
                                        }}"
                                        id="position_id"
                                        class="form-control text-dark"
                                        readonly
                                    >
                                </div>

                                <div class="col-md-6">
                                    <x-form.select
                                        :id="'department_id'"
                                        :name="'department_id'"
                                        :label="'Phòng ban'"
                                        :value="old('department_id') ?? $userProfile['department_id']"
                                        :data-select="$departments"
                                    />
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
                            </div>

                            <x-form.textarea
                                :id="'address'"
                                :name="'address'"
                                :label="'Địa chỉ'"
                                :placeholder="'Địa chỉ'"
                                :value="old('address') ?? $userProfile['address']"
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

    <x-custom.accordion-basic
        :title="'Lương chờ duyệt'"
        accordion-id="accordionPendingSalary"
        accordion-icon="loader"
    >
        <div id="timelineMinimal" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow" style="box-shadow: none">
            <div class="widget-content widget-content-area pb-1" style="border: none; background-color:rgba(255, 255, 255, 0)">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        @if (!empty($pendingSalary))
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Vị trí</th>
                                <th scope="col" class="text-end">Tiền lương</th>
                                <th scope="col" class="text-center">Tạo lúc</th>
                                <th scope="col" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    {{ $pendingSalary->position->name }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($pendingSalary->amount) }}
                                </td>
                                <td class="text-center">
                                    {{ formatDate($pendingSalary->created_at, 'd/m/Y') }}
                                </td>
                                <td class="text-center">
                                    <form
                                        action="{{ route('admin.salary.update', $pendingSalary) }}" method="POST"
                                    >
                                        @method('PUT')
                                        @csrf
                                        <button class="btn btn-sm btn-primary">
                                            Duyệt
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @else
                        <h3 style="color: #3b3f5c" class="text-center">
                            Không có lương chưa duyệt!
                        </h3>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        </div>
    </x-custom.accordion-basic>

     <x-custom.accordion-basic
        :title="'Lịch sử lương'"
        accordion-id="accordionSalaryHistory"
        accordion-icon="dollar-sign"
    >
        <div id="timelineMinimal" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow" style="box-shadow: none">
            <div class="widget-content widget-content-area pb-1" style="border: none; background-color:rgba(255, 255, 255, 0)">
                <div class="mt-container mx-auto">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="timeline-line">
                            @if ($allApprovedSalary->count() > 0)
                            @foreach ($allApprovedSalary as $key => $item)
                                <div class="item-timeline">
                                    <p class="t-time">
                                        {{ formatDate($item->approved_at, 'd/m/Y H:i:s') }}
                                    </p>

                                    <div class="t-dot t-dot-primary">
                                    </div>

                                    <div class="t-text">
                                        <p>
                                            Tiền lương
                                            :
                                            <b>{{ number_format($item->amount) }}</b>
                                        </p>

                                        <p>
                                            Vị trí:
                                            <b>{{ $item->position->name }}</b>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 style="color: #3b3f5c" class="text-center">Chưa có lịch sử lương!</h3>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </x-custom.accordion-basic>

    <input type="hidden" id="user_thumbnail" value="{{ $user->thumbnail }}">
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

        let tomSelectRoles = new TomSelect("#roles");

        @if(!empty($user->thumbnail))
            thumbnail.addFile($('#user_thumbnail').val());
        @endif

        let dt = flatpickr(document.getElementById('birthday'));

        function addIsInvalid(element, elementStatus, message){
                element.addClass('is-invalid');
                elementStatus.html('<strong>' + message + '</strong>');
            }

            function removeIsInvalid(element, elementStatus){
                element.removeClass('is-invalid');
                elementStatus.html('<strong></strong>');
            }

            function resetFormAddSalary(){
                $('#salary_amount').val('');
                removeIsInvalid(amount, amountStatus);

                $('#salary_position_id').val('');
                removeIsInvalid(positionId, positionIdStatus);

                $('#salary_status').prop('selectedIndex', 0);
                removeIsInvalid(statusInput, statusInputStatus);
            }

            const btnSubmitSalary = $('.btn-submit-salary');

            const amount = $('#salary_amount');
            const amountStatus = amount.parent().find('.invalid-feedback');

            const positionId = $('#salary_position_id');
            const positionIdStatus = positionId.parent().find('.invalid-feedback');

            const statusInput = $('#salary_status');
            const statusInputStatus = statusInput.parent().find('.invalid-feedback');

            btnSubmitSalary.click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.salary.store') }}',
                    data: {
                        _token: @json(@csrf_token()),
                        'salary_amount': amount.val(),
                        'salary_position_id': positionId.val(),
                        'salary_status': statusInput.val(),
                    },
                    success: function (response) {
                        btnSubmitSalary.closest('form').submit();
                    },
                    error: function (response) {
                        let errors = response.responseJSON.errors;

                        errors.salary_amount ?
                            addIsInvalid(amount, amountStatus, errors.salary_amount)
                            :
                            removeIsInvalid(amount, amountStatus);

                        errors.salary_position_id ?
                            addIsInvalid(positionId, positionIdStatus, errors.salary_position_id)
                            :
                            removeIsInvalid(positionId, positionIdStatus);

                        errors.salary_status ?
                            addIsInvalid(statusInput, statusInputStatus,errors.salary_status)
                            :
                            removeIsInvalid(statusInput, statusInputStatus);
                    }
                });
            });

            $('#salaryModal').on('show.bs.modal', function (e) {
                resetFormAddSalary();
            });
    </script>
@endsection
