@extends('layouts.admin')

@section('title')
    Cập nhật tuyển dụng
@endsection

@section('style-plugins')
    <link rel="stylesheet" href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/editors/quill/quill.snow.css') }}">

    <link rel="stylesheet" href="{{ asset('src/assets/css/light/apps/ecommerce-create.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/css/dark/apps/ecommerce-create.css') }}">
@endsection

@section('script-plugins')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    @include('includes.toast')

    <script src="{{ asset('src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('src/plugins/src/flatpickr/custom-flatpickr.js') }}"></script>

    <script src="{{ asset('src/plugins/src/editors/quill/quill.js') }}"></script>
@endsection

@section('content')
    <div class="layout-top-spacing col-12">
        <a href="{{ route('admin.recruitment.index') }}" class="btn btn-default _effect--ripple waves-effect waves-light">
            Trở lại
        </a>
    </div>
    <div class="row layout-top-spacing ">
        <div id="supplier-management" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Cập nhật tuyển dụng</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area" style="padding: 20px !important;">
                    <div class="col-lg-12">
                        <form id="myForm" method="POST" action="{{ route('admin.recruitment.update', $recruitment) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group mb-4">
                                    <label for="title">Tiêu đề <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="title"
                                        id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Tiêu đề"
                                        value="{{ old('title') ?? $recruitment->title }}"
                                        spellcheck="false"
                                    >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="department_id">Phòng ban cần tuyển <strong class="text-danger">*</strong>
                                    </label>
                                    <select class="form-select" id="department_id" name="department_id">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($departments as $department)
                                            <option
                                                @selected((old('department_id') ?? $recruitment->department_id) == $department->id)
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
                                    <label for="position_id">Vị trí cần tuyển <strong   class="text-danger">*</strong>
                                    </label>
                                    <select class="form-select" id="position_id" name="position_id">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($positions as $position)
                                            <option
                                                @selected((old('position_id') ?? $recruitment->position_id) == $position->id)
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
                                    <label for="quantity">Số lượng cần tuyển <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="quantity"
                                        id="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        placeholder="Số lượng cần tuyển"
                                        value="{{ old('quantity') ?? $recruitment->quantity }}"
                                        spellcheck="false"
                                    >
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="expired_time">Thời gian kết thúc <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="expired_time"
                                        id="expired_time"
                                        class="form-control @error('expired_time') is-invalid @enderror"
                                        placeholder="Thời gian kết thúc"
                                        value="{{ old('expired_time') ?? $recruitment->expired_time }}"
                                        spellcheck="false"
                                    >
                                    @error('expired_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="minimum_salary">Mức lương tối thiểu <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="minimum_salary"
                                        id="minimum_salary"
                                        class="form-control @error('minimum_salary') is-invalid @enderror"
                                        placeholder="Mức lương tối thiểu"
                                        value="{{ old('minimum_salary') ?? round($recruitment->minimum_salary, 4) }}"
                                        spellcheck="false"
                                    >
                                    @error('minimum_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="maximum_salary">Mức lương tối đa <strong class="text-danger">*</strong>
                                    </label>
                                    <input
                                        type="text"
                                        name="maximum_salary"
                                        id="maximum_salary"
                                        class="form-control @error('maximum_salary') is-invalid @enderror"
                                        placeholder="Mức lương tối đa"
                                        value="{{ old('maximum_salary') ?? round($recruitment->maximum_salary, 4) }}"
                                        spellcheck="false"
                                    >
                                    @error('maximum_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <div class="col-sm-12">
                                        <label for="description">Mô tả <strong class="text-danger">*</strong>
                                        </label>
                                        <div id="editor"></div>
                                        <input type="hidden" name="description" id="description"
                                        value="{{ old('description') ?? $recruitment->description }}">
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
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

    <input type="hidden" id="now" value="{{ getNowFormat('Y-m-d') }}">
@endsection

@section('script')
    <script>
        let expiredTime = flatpickr($('#expired_time'), {
            minDate: $('#now').val(),
        });

        let quill = new Quill('#editor', {
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    ['link', 'image', 'video', 'formula'],
                    [{
                        'header': 1
                    }, {
                        'header': 2
                    }],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'list': 'check'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],

                    [{
                        'size': ['small', false, 'large', 'huge']
                    }],
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],

                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'font': []
                    }],
                    [{
                        'align': []
                    }],
                    ['clean'],
                ]
            },
            placeholder: 'Mô tả',
            theme: 'snow',
        });
        quill.root.setAttribute('spellcheck', false);

        quill.root.innerHTML = $('#description').val();

        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let content = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
            document.getElementById('description').value = content;

            this.submit();
        });
    </script>
@endsection
