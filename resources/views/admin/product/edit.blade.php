@extends('layouts.admin')

@section('title')
    Cập nhật sản phẩm
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
    <form id="myForm" action="{{ route('admin.product.update', $product) }}" method="POST">
        @csrf
        @method("PUT")
        <div class="row mb-4 layout-spacing layout-top-spacing">
            <div class="widget-content widget-content-area ecommerce-create-section">
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label for="descriptilon">
                            Ảnh đại diện <strong class="text-danger">*</strong>
                        </label>
                        <input type="file" class="filepond file-upload" id="thumbnail" name="thumbnail">
                        @error('thumbnail')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <x-form.input
                    :id="'name'"
                    :name="'name'"
                    :label="'Tên'"
                    :placeholder="'Tên'"
                    :value="old('name') ?? $product->name"
                />

                <div class="row">
                    <div class="col-xxl-12 col-md-6">
                        <x-form.select
                            :id="'category_id'"
                            :name="'category_id'"
                            :label="'Danh mục sản phẩm'"
                            :value="old('category_id') ?? $product->category_id"
                            :data-select="$productCategories"
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <x-form.input
                            :id="'regular_price'"
                            :name="'regular_price'"
                            :label="'Giá nhập'"
                            :placeholder="'Giá nhập'"
                            :value="old('regular_price') ?? round($product->regular_price)"
                        />
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <x-form.input
                            :id="'sale_price'"
                            :name="'sale_price'"
                            :label="'Giá bán'"
                            :placeholder="'Giá bán'"
                            :value="old('sale_price') ?? round($product->sale_price)"
                        />
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label for="descriptilon">Mô tả <strong class="text-danger">*</strong>
                        </label>
                        <div id="description"></div>
                        <textarea id="descriptionTextarea" name="description" class="d-none">{{ old('description') ?? $product->description }}</textarea>
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

                <button type="submit" class="btn btn-primary _effect--ripple waves-effect waves-light">
                    Hoàn tất
                </button>
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

        thumbnail.addFile(`{{ $product->thumbnail }}`);

        images.addFiles({!! json_encode($product->images) !!});
    </script>
@endsection
