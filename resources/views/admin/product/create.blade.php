@extends('layouts.admin')

@section('title')
    Thêm mới sản phẩm
@endsection

@section('style-plugins')
    <link rel="stylesheet" href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/tagify/tagify.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/forms/switches.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/forms/switches.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/editors/quill/quill.snow.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/tagify/custom-tagify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/tagify/custom-tagify.css') }}">

    <link rel="stylesheet" href="{{ asset('src/assets/css/light/apps/ecommerce-create.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/css/dark/apps/ecommerce-create.css') }}">

    <link rel="stylesheet" href="{{ asset('src/plugins/src/filepond/filepond.min.css') }}">
    <link href="{{ asset('src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">
@endsection

@section('script-plugins')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    @include('includes.toast')

    <script src="{{ asset('src/plugins/src/editors/quill/quill.js') }}"></script>

    <script src="{{ asset('src/plugins/src/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
@endsection

@section('content')
    <div class="layout-top-spacing col-12">
        <a href="{{ route('admin.product.index') }}" class="btn btn-default _effect--ripple waves-effect waves-light">
            Trở lại
        </a>
    </div>
    <form id="myForm" action="{{ route('admin.product.store') }}" method="POST">
        @csrf
        <div class="row mb-4 layout-spacing layout-top-spacing">
            <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="widget-content widget-content-area ecommerce-create-section">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="descriptilon">Ảnh đại diện <strong class="text-danger">*</strong></label>
                            <input type="file" class="filepond file-upload" id="thumbnail" name="thumbnail">
                            @error('thumbnail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="form-group mb-4">
                            <label for="name">Tên <strong class="text-danger">*</strong>
                            </label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Tên" value="{{ old('name') }}" spellcheck="false">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label for="descriptilon">Mô tả <strong class="text-danger">*</strong>
                            </label>
                            <div id="description"></div>
                            <textarea id="descriptionTextarea" name="description" style="display:none;">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-4">
                            <label for="images">Hình ảnh liên quan <strong class="text-danger">*</strong>
                            </label>
                            <div class="multiple-file-upload">
                                <input type="file" name="images[]" class="filepond file-upload-multiple" id="images"
                                    accept="image/*" multiple data-allow-reorder="true">
                            </div>
                            @error('images.*')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-xxl-12 col-xl-8 col-lg-8 col-md-7 mt-xxl-0 mt-4">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <div class="row">
                                <div class="col-xxl-12 col-md-6 mb-4">
                                    <label for="category_id">Danh mục sản phẩm <strong class="text-danger">*</strong>
                                    </label></label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($productCategories as $item)
                                            <option @selected($item->id == old('category_id')) value="{{ $item->id }}">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-xl-4 col-lg-4 col-md-5 mt-4">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <label for="regular-price">Giá nhập <strong class="text-danger">*</strong>
                                    </label></label>
                                    <input type="text" class="form-control" name="regular_price" id="regular-price"
                                        value="{{ old('regular_price') }}" placeholder="Giá nhập" spellcheck="false">
                                    @error('regular_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-4">
                                    <label for="sale-price">Giá bán <strong class="text-danger">*</strong>
                                    </label>
                                    <input type="text" class="form-control" name="sale_price" id="sale-price"
                                        value="{{ old('sale_price') }}" placeholder="Giá bán" spellcheck="false">
                                    @error('sale_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit"
                                        class="btn btn-primary w-100 _effect--ripple waves-effect waves-light">
                                        Hoàn tất
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        let quill = new Quill('#description', {
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
            spellcheck: false,
            theme: 'snow',
        });
        quill.root.setAttribute('spellcheck', false);

        document.querySelector('.ql-editor')
            .innerHTML = document.getElementById('descriptionTextarea').value;

        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let quillContent = document.querySelector('.ql-editor')
                .innerHTML;
            let isEmpty = quillContent === '<p><br></p>';
            if (isEmpty) {
                quillContent = '';
            }
            document.getElementById('descriptionTextarea').value =
                quillContent;

            this.submit();
        });

        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginImageTransform,
            // FilePondPluginFileEncode,
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

        const images = FilePond.create(
            document.querySelector('#images'), {
                acceptedFileTypes: ['image/*'],
                labelFileTypeNotAllowed: 'sai định dạng',
                fileValidateTypeLabelExpectedTypes: 'phải là hình ảnh',
                maxFileSize: '5MB',
                labelMaxFileSizeExceeded: 'Tệp quá lớn',
                labelMaxFileSize: 'Kích thước ảnh tối đa 5MB',
                labelIdle: 'Kéo & thả hoặc <span class="filepond--label-action">chọn từ thiết bị</span>',
            }
        );

        // FilePond.setOptions({
        //     server: {
        //         url: '/upload',
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //         }
        //     }
        // });

        // @if (old('thumbnail'))
        //     thumbnail.addFile('{{ getImageInStorage('thumbnail') }}');
        // @endif

        // @if (old('images'))
        //     images.addFiles({!! json_encode(getImageListInStorage('images')) !!});
        // @endif
    </script>
@endsection
