@extends('layouts/contentLayoutMaster')

@section('title', 'Cập nhật')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <style>
        .ql-editor {
            min-height: 200px;
        }

        .form-group.invalid .form-control {
            border-color: #ea5455;
            padding-right: calc(1.45em + 0.876rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23ea5455' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23ea5455' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.3625em + 0.219rem) center;
            background-size: calc(0.725em + 0.438rem) calc(0.725em + 0.438rem);
        }

        .form-group.invalid .form-message {
            color: #f33a58;
        }

        .form-message {
            text-align: left;
        }
    </style>
@endsection
@section('content')
    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thông tin chi tiết</h4>
            </div>
            <div class="card-body">
                <form class="form-horizontal form" id="main-form" action="{{ route('products.update', $item->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="name">{{ config('label.products.name') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="name" class="form-control" name="name"
                                            value="{{ $item->name }}" />
                                    </div>
                                    {{-- @if ($errors->has('name'))
                                        <script>
                                        document.getElementById("name").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('name') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="sub_name">{{ config('label.products.sub_name') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="sub_name" class="form-control" name="sub_name"
                                            value="{{ $item->sub_name }}" />
                                    </div>
                                    {{-- @if ($errors->has('sub_name'))
                                        <script>
                                        document.getElementById("sub_name").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('sub_name') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.artists.images') }}<span
                                            class="text-danger">*</span> <span
                                            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
                                            500</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <button id="select-images" class="btn btn-outline-primary mb-1">
                                        <i data-feather="file"></i> Chọn ảnh
                                    </button>
                                    <input type="file" id="images" class="form-control hidden" name="images[]"
                                        accept="image/*" />
                                    @if ($item->images)
                                        <div class="row" id="images">
                                            <div class="col-2">
                                                <img src="{{ URL::to('/images/products') . '/' . $item->images }} "
                                                    alt="" width="100%">
                                            </div>
                                        </div>
                                    @endif
                                    <ul class="list-group" id="list-images">
                                    </ul>
                                    {{-- @if ($errors->has('images'))
                                        <script>
                                        document.getElementById("images").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('images') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="teacher_id">{{ config('label.products.teacher') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="select2 form-control form-control-lg is-invalid" name="teacher_id"
                                        id="teacher_id">
                                        <option value="">-- Lựa chọn --</option>
                                        @foreach ($teachers as $teacher)
                                            @if ($teacher->id == $item->teacher_id)
                                                <option value="{{ $teacher->id }}" selected>{{ $teacher->name }}
                                                </option>
                                            @else
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('teacher_id'))
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('teacher_id') }}</div>
                                    @endif
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="name">{{ config('label.products.name_artist') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="name_artist" class="form-control" name="name_artist" value="{{ $item->name_artist }}"/>
                                    </div>
                                    {{-- @if ($errors->has('name'))
                                        <script>
                                            document.getElementById("name").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('name') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.products.images_artist') }}<span
                                        class="text-danger">*</span><span
                                            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
                                            500</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <button id="select-images_artist" class="btn btn-outline-primary mb-1">
                                        <i data-feather="file"></i> Chọn ảnh
                                    </button>
                                    <input type="file" id="images_artist" class="form-control hidden"
                                        name="images_artist[]" accept="image/*" />
                                    @if ($item->images_artist)
                                        <div class="row" id="images_artist">
                                            <div class="col-2">
                                                <img src="{{ URL::to('/images/products') . '/' . $item->images_artist }} "
                                                    alt="" width="100%">
                                            </div>
                                        </div>
                                    @endif
                                    <ul class="list-group" id="list-images_artist">

                                    </ul>
                                    {{-- @if ($errors->has('image_artist'))
                                        <script>
                                            document.getElementById("image_artist").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $errors->first('image_artist') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.artists.profile') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="profile_artist" id="profile_artist" placeholder="Nội dung text"
                                        id="floatingTextarea2" style="height: 100px">{{ $item->profile_artist }}</textarea>
                                    {{-- @if ($errors->has('description'))
                                        <script>
                                            document.getElementById("description").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('description') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.products.description') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="description" id="description" placeholder="Nội dung text"
                                        id="floatingTextarea2" style="height: 100px">{{ $item->description }}</textarea>
                                    {{-- @if ($errors->has('description'))
                                        <script>
                                        document.getElementById("description").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('description') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="start_time">{{ config('label.products.start_time') }}<span
                                        class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="start_time" class="form-control" name="start_time"
                                            value="{{ $item->start_time }}" />
                                    </div>
                                    {{-- @if ($errors->has('start_time'))
                                        <script>
                                            document.getElementById("start_time").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $errors->first('start_time') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="end_time">{{ config('label.products.end_time') }}<span
                                        class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="end_time" class="form-control" name="end_time"
                                            value="{{ $item->end_time }}" />
                                    </div>
                                    {{-- @if ($errors->has('end_time'))
                                        <script>
                                            document.getElementById("end_time").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $errors->first('end_time') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="block_1_title">{{ config('label.products.block_1_title') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="block_1_title" class="form-control"
                                            name="block_1_title" value="{{ $item->block_1_title }}" />
                                    </div>
                                    {{-- @if ($errors->has('block_1_title'))
                                        <script>
                                        document.getElementById("block_1_title").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('block_1_title') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.products.block_1_image') }} <span
                                            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
                                            500</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <button id="select-block_1_image" class="btn btn-outline-primary mb-1">
                                        <i data-feather="file"></i> Chọn ảnh
                                    </button>
                                    <input type="file" id="block_1_image" class="form-control hidden"
                                        name="block_1_image[]" accept="image/*" />
                                    @if ($item->block_1_image)
                                        <div class="row" id="block_1_image">
                                            <div class="col-2">
                                                <img src="{{ URL::to('/images/products') . '/' . $item->block_1_image }} "
                                                    alt="" width="100%">
                                            </div>
                                        </div>
                                    @endif
                                    <ul class="list-group" id="list-block_1_image">

                                    </ul>
                                    @if ($errors->has('block_1_image'))
                                        <script>
                                            document.getElementById("block_1_image").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $errors->first('block_1_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.products.block_1_content') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="block_1_content" id="block_1_content" placeholder="Nội dung text"
                                        id="floatingTextarea2" style="height: 100px">{{ $item->block_1_content }}</textarea>
                                    {{-- @if ($errors->has('block_1_content'))
                                        <script>
                                        document.getElementById("block_1_content").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('block_1_content') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="block_2_title">{{ config('label.products.block_2_title') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="block_2_title" class="form-control"
                                            name="block_2_title" value="{{ $item->block_2_title }}" />
                                    </div>
                                    {{-- @if ($errors->has('block_2_title'))
                                        <script>
                                        document.getElementById("block_2_title").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('block_2_title') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.products.block_2_image') }} <span
                                            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
                                            500</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <button id="select-block_2_image" class="btn btn-outline-primary mb-1">
                                        <i data-feather="file"></i> Chọn ảnh
                                    </button>
                                    <input type="file" id="block_2_image" class="form-control hidden"
                                        name="block_2_image[]" accept="image/*" />
                                    @if ($item->block_2_image)
                                        <div class="row" id="block_2_image">
                                            <div class="col-2">
                                                <img src="{{ URL::to('/images/products') . '/' . $item->block_2_image }} "
                                                    alt="" width="100%">
                                            </div>
                                        </div>
                                    @endif
                                    <ul class="list-group" id="list-block_2_image">

                                    </ul>
                                    @if ($errors->has('block_2_image'))
                                        <script>
                                            document.getElementById("block_2_image").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $errors->first('block_2_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.products.block_2_content') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    {{-- <textarea class="form-control" name="block_2_content" id="block_2_content" placeholder="Nội dung text"
                                        id="floatingTextarea2" style="height: 100px">{{ $item->block_2_content }}</textarea> --}}
                                    <textarea class="form-control" name="block_2_content" id="block_2_content" placeholder="Nội dung text"
                                        id="floatingTextarea2" style="height: 100px">{{ $item->block_2_content }}</textarea>
                                    {{-- @if ($errors->has('block_2_content'))
                                        <script>
                                        document.getElementById("block_2_content").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('block_2_content') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="block_3_title">{{ config('label.products.block_3_title') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="block_3_title" class="form-control"
                                            name="block_3_title" value="{{ $item->block_3_title }}" />
                                    </div>
                                    {{-- @if ($errors->has('block_3_title'))
                                        <script>
                                        document.getElementById("block_3_title").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('block_3_title') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.products.block_3_image') }} <span
                                            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
                                            500</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <button id="select-block_3_image" class="btn btn-outline-primary mb-1">
                                        <i data-feather="file"></i> Chọn ảnh
                                    </button>
                                    <input type="file" id="block_3_image" class="form-control hidden"
                                        name="block_3_image[]" accept="image/*" />
                                    @if ($item->block_3_image)
                                        <div class="row" id="block_3_image">
                                            <div class="col-2">
                                                <img src="{{ URL::to('/images/products') . '/' . $item->block_3_image }} "
                                                    alt="" width="100%">
                                            </div>
                                        </div>
                                    @endif
                                    <ul class="list-group" id="list-block_3_image">

                                    </ul>
                                    @if ($errors->has('block_3_image'))
                                        <script>
                                            document.getElementById("block_3_image").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $errors->first('block_3_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.products.block_3_content') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    {{-- <textarea class="form-control" name="block_3_content" id="block_3_content" placeholder="Nội dung text"
                                        id="floatingTextarea2" style="height: 100px">{{ $item->block_3_content }}</textarea> --}}
                                    <textarea class="form-control" name="block_3_content" id="block_3_content" placeholder="Nội dung text"
                                        id="floatingTextarea2" style="height: 100px">{{ $item->block_3_content }}</textarea>
                                    {{-- @if ($errors->has('block_3_content'))
                                        <script>
                                        document.getElementById("block_3_content").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('block_3_content') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        @php
                            // $listOption = file_get_contents(base_path('resources/data/list-profit-optons.json'));
                            // $listOption = json_decode($listOption, true);
                            // $listOption = $listOption['profit'];

                            $listOptionFree = file_get_contents(base_path('resources/data/list-profit-free-optons.json'));
                            $listOptionFree = json_decode($listOptionFree, true);
                            $listOptionFree = $listOptionFree['profit'];

                            $listOptionBasic = file_get_contents(base_path('resources/data/list-profit-basic-optons.json'));
                            $listOptionBasic = json_decode($listOptionBasic, true);
                            $listOptionBasic = $listOptionBasic['profit'];

                            $listOptionPro = file_get_contents(base_path('resources/data/list-profit-pro-optons.json'));
                            $listOptionPro = json_decode($listOptionPro, true);
                            $listOptionPro = $listOptionPro['profit'];
                        @endphp

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="free_price">{{ config('label.products.free_price') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="free_price" name="free_price" class="form-control"
                                            value="{{ $item->free_price }}" placeholder="mệnh giá VND"
                                            id="free_price" />
                                    </div>
                                    {{-- @if ($errors->has('free_price'))
                                        <script>
                                        document.getElementById("free_price").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('free_price') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>
                        @php
                            if (isset($item->basic_benefit)) {
                                $free_benefit = explode(',', $item->free_benefit);
                                $basic_benefit = explode(',', $item->basic_benefit);
                                $pre_benefit = explode(',', $item->pre_benefit);
                            }
                        @endphp
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="free_benefit">{{ config('label.products.free_benefit') }}<span
                                            class="text-danger">*</span></label>
                                </div>

                                <div class="col-sm-9">
                                    <select class="select2 form-control form-control-lg" name="free_benefit[]"
                                        id="free_benefit" multiple>
                                        @foreach ($listOptionFree as $key => $opt)
                                            @if (in_array($key, $free_benefit))
                                                <option value="{{ $key }}" selected>{{ $opt }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $opt }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {{-- @if ($errors->has('free_benefit'))
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('free_benefit') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="basic_price">{{ config('label.products.basic_price') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="basic_price" name="basic_price" class="form-control"
                                            value="{{ $item->basic_price }}" placeholder="mệnh giá VND"
                                            id="basic_price" />
                                    </div>
                                    {{-- @if ($errors->has('basic_price'))
                                        <script>
                                        document.getElementById("basic_price").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('basic_price') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="basic_benefit">{{ config('label.products.basic_benefit') }}<span
                                            class="text-danger">*</span></label>
                                </div>

                                <div class="col-sm-9">
                                    <select class="select2 form-control form-control-lg is-invalid" name="basic_benefit[]"
                                        id="basic_benefit" multiple>
                                        @foreach ($listOptionBasic as $key => $opt)
                                            @if (in_array($key, $basic_benefit))
                                                <option value="{{ $key }}" selected>{{ $opt }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $opt }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {{-- @if ($errors->has('basic_benefit'))
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('basic_benefit') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="premium_price">{{ config('label.products.premium_price') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="premium_price" name="premium_price"
                                            class="form-control" value="{{ $item->premium_price }}"
                                            placeholder="mệnh giá VND" id="premium_price" />
                                    </div>
                                    {{-- @if ($errors->has('premium_price'))
                                        <script>
                                        document.getElementById("premium_price").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('premium_price') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="pre_benefit">{{ config('label.products.pre_benefit') }}<span
                                            class="text-danger">*</span></label>
                                </div>

                                <div class="col-sm-9">
                                    <select class="select2 form-control form-control-lg is-invalid" name="pre_benefit[]"
                                        id="pre_benefit" multiple>
                                        @foreach ($listOptionPro as $key => $opt)
                                            @if (in_array($key, $pre_benefit))
                                                <option value="{{ $key }}" selected>{{ $opt }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $opt }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {{-- @if ($errors->has('pre_benefit'))
                                        <div class="invalid-feedback" style="display: block;">{{ $errors->first('pre_benefit') }}</div>
                                    @endif --}}
                                    <div><span class="form-message"></span></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label font-weight-bold">
                                    <label for="color">{{ config('label.products.comments') }} <span
                                            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
                                            500</span></label>
                                </div>
                                <div class="col-sm-9">
                                    <button id="select-comments" class="btn btn-outline-primary mb-1">
                                        <i data-feather="file"></i> Chọn ảnh
                                    </button>
                                    <input type="file" id="comments" class="form-control hidden" name="comments[]"
                                        multiple accept="image/*" />
                                    @if ($item->comments)
                                        <div class="row" id="comments">
                                            @foreach ($item->comments as $comment)
                                                <div class="col-2">
                                                    <img src="{{ URL::to('/images/products') . '/' . $comment }} "
                                                        alt="" width="100%">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <ul class="list-group" id="list-comments">

                                    </ul>
                                    @if ($errors->has('comments'))
                                        <script>
                                            document.getElementById("comments").classList.add("is-invalid");
                                        </script>
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $errors->first('comments') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-12">
                            <textarea id="editor" name="editor"></textarea>
                        </div> --}}

                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary mr-1" id="submitForm">Lưu</button>
                            <button type="reset" class="btn btn-outline-secondary">Trở lại</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Basic Horizontal form layout section end -->
@endsection
@section('page-script')
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    {{-- number input --}}
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
    <script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('block_3_content');
        CKEDITOR.replace('block_2_content');
        CKEDITOR.replace('block_1_content');
        CKEDITOR.replace('description');
        CKEDITOR.replace('profile_artist');

        $(document).ready(function() {

            $('#start_time').flatpickr();
            $('#end_time').flatpickr();

            $('#select-images').click(function() {
                $('#images').click()
                return false
            })
            $('#images').change(function() {
                var html = ''
                if (this.files.length > 0) {
                    console.log(this.files);
                    for (let i = 0; i < this.files.length; i++) {
                        html +=
                            '<li class="list-group-item list-group-item-action list-group-item-success">' +
                            this.files[i].name + '(' + this.files[i].size + 'B)</li>'
                    }
                    $('#list-images').html(html)
                }
            })

            $('#select-images_artist').click(function() {
                $('#images_artist').click()
                return false
            })

            $('#images_artist').change(function() {
                var html = ''
                if (this.files.length > 0) {
                console.log(this.files);
                for (let i = 0; i < this.files.length; i++) {
                    html += '<li class="list-group-item list-group-item-action list-group-item-success">' + this.files[i]
                    .name + '(' + this.files[i].size + 'B)</li>'
                }
                $('#list-images_artist').html(html)
                }
            })

            //block_1_image
            $('#select-block_1_image').click(function() {
                $('#block_1_image').click()
                return false
            })
            $('#block_1_image').change(function() {
                var html = ''
                if (this.files.length > 0) {
                    for (let i = 0; i < this.files.length; i++) {
                        html +=
                            '<li class="list-group-item list-group-item-action list-group-item-success">' +
                            this.files[i].name + '(' + this.files[i].size + 'B)</li>'
                    }
                    $('#list-block_1_image').html(html)
                }
            })

            //block_2_image
            $('#select-block_2_image').click(function() {
                $('#block_2_image').click()
                return false
            })
            $('#block_2_image').change(function() {
                var html = ''
                if (this.files.length > 0) {
                    for (let i = 0; i < this.files.length; i++) {
                        html +=
                            '<li class="list-group-item list-group-item-action list-group-item-success">' +
                            this.files[i].name + '(' + this.files[i].size + 'B)</li>'
                    }
                    $('#list-block_2_image').html(html)
                }
            })

            //block_3_image
            $('#select-block_3_image').click(function() {
                $('#block_3_image').click()
                return false
            })
            $('#block_3_image').change(function() {
                var html = ''
                if (this.files.length > 0) {
                    for (let i = 0; i < this.files.length; i++) {
                        html +=
                            '<li class="list-group-item list-group-item-action list-group-item-success">' +
                            this.files[i].name + '(' + this.files[i].size + 'B)</li>'
                    }
                    $('#list-block_3_image').html(html)
                }
            })

            //comments
            $('#select-comments').click(function() {
                $('#comments').click()
                return false
            })
            $('#comments').change(function() {
                var html = ''
                if (this.files.length > 0) {
                    for (let i = 0; i < this.files.length; i++) {
                        html +=
                            '<li class="list-group-item list-group-item-action list-group-item-success">' +
                            this.files[i].name + '(' + this.files[i].size + 'B)</li>'
                    }
                    $('#list-comments').html(html)
                }
            })


            function uploadFile(file) {
                var _token = $("input[name='_token']").val();
                var formData = new FormData()
                var res = ''
                formData.append('_token', _token)
                formData.append('image', file)

                $.ajax({
                    url: "{{ route('products.handlerImage') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        var link = "{{ URL::to('/') }}" + data.urlImg
                        var range = snowEditor.getSelection();

                        console.log('User trying to uplaod this:', link);
                        // this part the image is inserted
                        // by 'image' option below, you just have to put src(link) of img here.
                        snowEditor.insertEmbed(range, 'image', link);
                    }
                });
            }

            function imageHandler(image, callback) {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();
                input.onchange = async function() {
                    const file = input.files[0];

                    const link = await uploadFile(file); // I'm using react, so whatever upload function
                };
            }

            // $('#submitForm').click(function () {
            //   $('#main-form').submit()
            // })

        })
        document.addEventListener('DOMContentLoaded', function() {
            // console.log($('#start_time').val())
            // Mong muốn của chúng ta
            Validator({
                form: '#main-form',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#name', "vui lòng nhập Tên khóa học !"),
                    Validator.isRequired('#name_artist', "vui lòng nhập Tên Nghệ Sỹ !"),
                    Validator.isRequired('#sub_name', "vui lòng nhập Slogan !"),
                    // Validator.isRequired('#teacher_id', "vui lòng chọn Nghệ sỹ !"),
                    // Validator.isRequired('#description', "vui lòng nhập Mô tả !"),
                    Validator.isRequired('#start_time', "vui lòng chọn Thời gian bắt đầu !"),
                    Validator.isRequired('#end_time', "vui lòng chọn Thời gian kết thúc !"),
                    Validator.isRequired('#block_1_title', "vui lòng nhập Tiêu đề lock 1 !"),
                    // Validator.isRequired('#block_1_content', "vui lòng nhập Nội dung block 1 !"),
                    Validator.isRequired('#block_2_title', "vui lòng nhập Tiêu đề lock 2 !"),
                    // Validator.isRequired('#block_2_content', "vui lòng nhập Nội dung block 2 !"),
                    Validator.isRequired('#block_3_title', "vui lòng nhập Tiêu đề lock 3 !"),
                    // Validator.isRequired('#block_3_content', "vui lòng nhập Nội dung block 3 !"),
                    Validator.isRequired('#free_price', "vui lòng nhập Giá gói free !"),
                    Validator.isRequired('#free_benefit', "vui lòng chọn Lợi ích giá gói free!"),
                    Validator.isRequired('#basic_price', "vui lòng nhập Giá gói basic !"),
                    Validator.isRequired('#basic_benefit', "vui lòng chọn Lợi ích giá gói basic!"),
                    Validator.isRequired('#premium_price', "vui lòng nhập Giá gói Premium !"),
                    Validator.isRequired('#pre_benefit', "vui lòng chọn Lợi ích giá gói Premium!"),
                    // Validator.isRequired('#images', "vui lòng chọn Hình ảnh!"),
                    Validator.minLength('#name', 2),
                    Validator.minLength('#sub_name', 2),
                    // Validator.minLength('#description', 2)
                ],
                onSubmit: function(data) {
                    // $('#main-form').submit()
                    // console.log(data);
                }
            });
        });
    </script>

@endsection
