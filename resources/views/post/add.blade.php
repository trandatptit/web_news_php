@extends('template.master')

@section('title', 'Thêm bài viết')

{{-- @section('heading', 'Thêm bài viết') --}}

@section('posts', 'active')

@section('add-posts', 'active')

@section('open-posts', 'menu-open')
@section('style')
    <!-- <link href="{{ asset('admin_dashboard_assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" /> -->

    <link href="{{ asset('assets') }}/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

    <link href="{{ asset('assets') }}/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />


    <script src="https://cdn.tiny.cloud/1/5nk94xe9fcwk22fkp6gou9ymszwidnujnr2mu3n3xe2biap3/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Bài viết</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin/posts/list') }}">
                                <i class="fa-regular fa-circle-left"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm mới bài viết</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-4">
                    <form action=" {{ url('admin/posts/add') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                        <div class="form-body mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Tiêu đề bài viết</label>
                                            <input type="text" value='{{ old('title') }}' name="title" required
                                                class="inputPostTitle form-control" id="inputProductTitle"
                                                placeholder="Nhập tiêu đề bài viết">

                                            @error('title')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Slug - liên kết</label>
                                            <input type="text" value='{{ old('slug') }}' name="slug" required
                                                class="slugPost form-control" id="inputProductTitle"
                                                placeholder="Nhập slug">

                                            @error('slug')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Mô tả</label>
                                            <textarea required name="excerpt" class="form-control" id="inputProductDescription" rows="3"></textarea>


                                            @error('excerpt')
                                                <p class="text-danger"></p>
                                            @enderror

                                        </div>

                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Danh mục bài viết</label>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="p-3 rounded">
                                                        <div class="mb-3">
                                                            <select name="category_id" required class="select">
                                                                @foreach ($Category as $k => $v)
                                                                    <option value="{{ $v->id }}">
                                                                        {{ $v->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            @error('category_id')
                                                                <p class="text-danger"></p>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Hình ảnh bài
                                                viết</label>
                                            <input id="avatar" require name="avatar" type="file" id="file">

                                            @error('avatar')
                                                <p class="text-danger"></p>
                                            @enderror

                                        </div>

                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Nội dung bài
                                                viết</label>
                                            <textarea name="body" id="post_content" class="form-control" id="inputProductDescription" rows="3">{{ old('body') }}</textarea>

                                            @error('body')
                                                <p class="text-danger"></p>
                                            @enderror

                                        </div>

                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <div class="form-check form-switch">
                                                    <!-- Hidden input để gửi giá trị 0 khi checkbox không được chọn -->
                                                    <input type="hidden" name="approved" value="0">
                                                    <!-- Checkbox input để gửi giá trị 1 khi được chọn -->
                                                    <input name="approved" class="form-check-input" type="checkbox" value="1" id="flexSwitchChecked">
                                                    <label class="form-check-label" for="flexSwitchChecked">
                                                        Phê duyệt ngay
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Thêm bài viết</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @stop --}}
@section('script')
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('assets') }}s/plugins/input-tags/js/tagsinput.js"></script>
    
    <script>
        $(document).ready(function() {
            // $('#image-uploadify').imageuploadify();

            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });

            $('.multiple-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });

            tinymce.init({
                selector: '#post_content',
                // plugins: 'advlist autolink lists link image media charmap print preview hr anchor pagebreak',
                plugins: 'advlist autolink lists link image media charmap preview anchor pagebreak',
                toolbar_mode: 'floating',
                height: '500',

                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | rtl ltr',
                toolbar_mode: 'floating',

                image_title: true,
                automatic_uploads: true,

                images_upload_handler: function(blobinfo, success, failure) {
                    let formData = new FormData();
                    let _token = $("input[name='_token']").val();
                    let xhr = new XMLHttpRequest();
                    xhr.open('post', "#");
                    xhr.onload = () => {
                        if (xhr.status !== 200) {
                            failure("Http Error: " + xhr.status);
                            return
                        }
                        let json = JSON.parse(xhr.responseText);
                        if (!json || typeof json.location != 'string') {
                            failure("Invalid JSON: " + xhr.responseText);
                            return
                        }
                        success(json.location);

                    }

                    formData.append('_token', _token);
                    formData.append('file', blobinfo.blob(), blobinfo.filename());
                    xhr.send(formData);
                }

            });

            setTimeout(() => {
                $(".general-message").fadeOut();
            }, 5000);

        });
    </script>

<script>
    $(document).ready(function() {
        function removeVietnameseTones(str) {
            str = str.replace(/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/g, "a"); 
            str = str.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/g, "e"); 
            str = str.replace(/i|í|ì|ỉ|ĩ|ị/g, "i"); 
            str = str.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/g, "o"); 
            str = str.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/g, "u"); 
            str = str.replace(/ý|ỳ|ỷ|ỹ|ỵ/g, "y"); 
            str = str.replace(/đ/g, "d");
            str = str.replace(/Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ/g, "A"); 
            str = str.replace(/É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ/g, "E"); 
            str = str.replace(/I|Í|Ì|Ỉ|Ĩ|Ị/g, "I"); 
            str = str.replace(/Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ/g, "O"); 
            str = str.replace(/Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự/g, "U"); 
            str = str.replace(/Ý|Ỳ|Ỷ|Ỹ|Ỵ/g, "Y"); 
            str = str.replace(/Đ/g, "D");
            // Some system encode vietnamese combining accent as individual utf-8 characters
            str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // Huyền sắc hỏi ngã nặng 
            str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // Â, Ê, Ă, Ơ, Ư
            return str;
        }

        $('.inputPostTitle').on('input', function() {
            let title = $(this).val();
            let slug = removeVietnameseTones(title).toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('.slugPost').val(slug);
        });
    });
</script>

@endsection
