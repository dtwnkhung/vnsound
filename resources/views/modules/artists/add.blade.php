@extends('layouts/contentLayoutMaster')

@section('title', 'Thêm mới')

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
      <form class="form-horizontal form" id="main-form" action="{{ route('artists.store') }}" method="POST"
        enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col-12">
            <div class="form-group row">
              <div class="col-sm-3 col-form-label font-weight-bold">
                <label for="name">{{ config('label.artists.name') }}<span class="text-danger">*</span></label>
              </div>
              <div class="col-sm-9">
                <div class="input-group input-group-merge">
                  <input type="text" id="name" value="" class="form-control" name="name" />
                </div>
                <span class="form-message"></span>
                {{-- @if ($errors->has('name'))
                                    <script>
                                      document.getElementById("name").classList.add("is-invalid");
                                    </script>
                                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('name') }}
              </div>
              @endif --}}
            </div>
          </div>
        </div>
        <div class="col-12 d-none">
          <div class="form-group row">
            <div class="col-sm-3 col-form-label font-weight-bold">
              <label for="name">slug<span class="text-danger">*</span></label>
            </div>
            <div class="col-sm-9">
              <div class="input-group input-group-merge">
                <input type="text" id="slug" value="" class="form-control" name="slug" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="form-group row">
            <div class="col-sm-3 col-form-label font-weight-bold">
              <label for="color">{{ config('label.artists.images') }} <span class="text-danger">*</span> <span
                  class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
                  500</span></label>
            </div>
            <div class="col-sm-9">
              <button id="select-images" class="btn btn-outline-primary mb-1">
                <i data-feather="file"></i> Chọn ảnh
              </button>
              <input type="file" id="images" class="form-control hidden" name="images[]" accept="image/*" />
              <ul class="list-group" id="list-images"></ul>
              <span class="form-message"></span>
              {{-- @if ($errors->has('images'))
                                    <script>
                                      document.getElementById("images").classList.add("is-invalid");
                                    </script>
                                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('images') }}
            </div>
            @endif --}}
          </div>
        </div>
    </div>
    <div class="col-12">
      <div class="form-group row">
        <div class="col-sm-3 col-form-label font-weight-bold">
          <label for="color">{{ config('label.artists.banner') }}<span class="text-danger">*</span></label>
        </div>
        <div class="col-sm-9">
          <button id="select-banner" class="btn btn-outline-primary mb-1">
            <i data-feather="file"></i> Chọn ảnh
          </button>
          <input type="file" id="banner" class="form-control hidden" name="banner[]" accept="image/*" />
          <ul class="list-group" id="list-banner"></ul>
          <span class="form-message"></span>
          {{-- @if ($errors->has('banner'))
                                    <script>
                                      document.getElementById("banner").classList.add("is-invalid");
                                    </script>
                                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('banner') }}
        </div>
        @endif --}}
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.profile') }}<span class="text-danger">*</span></label>
      </div>
      <div class="col-sm-9">
        <textarea class="form-control" name="profile" id="profile" placeholder="Nội dung text" id="floatingTextarea2"
          style="height: 100px"></textarea>
        {{-- @if ($errors->has('profile'))
                                      <script>
                                        document.getElementById("profile").classList.add("is-invalid");
                                      </script>
                                      <div class="invalid-feedback" style="display: block;">{{ $errors->first('profile') }}
      </div>
      @endif --}}
      <div><span class="form-message"></span></div>
    </div>
  </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.partners') }} <span
            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x 500
          </span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-partners" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="partners" class="form-control hidden" name="partners[]" multiple accept="image/*" />
        <ul class="list-group" id="list-partners">

        </ul>
        {{-- @if ($errors->has('partners'))
                                    <script>
                                      document.getElementById("partners").classList.add("is-invalid");
                                    </script>
                                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('partners') }}
      </div>
      @endif --}}
    </div>
    <span class="form-message"></span>
  </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.clubs') }} <span class="text-danger font-italic d-block w-100">Kích
            thước ảnh 500 x 500
          </span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-clubs" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="clubs" class="form-control hidden" name="clubs[]" multiple accept="image/*" />
        <ul class="list-group" id="list-clubs">

        </ul>
        @if ($errors->has('clubs'))
        <script>
        document.getElementById("clubs").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('clubs') }}</div>
        @endif
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="project_1_title">{{ config('label.artists.project_1_title') }}<span
            class="text-danger">*</span></label>
      </div>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <input type="text" id="project_1_title" class="form-control" name="project_1_title" />
        </div>
        {{-- @if ($errors->has('project_1_title'))
                                    <script>
                                      document.getElementById("project_1_title").classList.add("is-invalid");
                                    </script>
                                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('project_1_title') }}
      </div>
      @endif --}}
      <div><span class="form-message"></span></div>
    </div>
  </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.project_1_image') }} <span class="text-danger">*</span> <span
            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
            500</span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-project_1_image" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="project_1_image" class="form-control hidden" name="project_1_image[]" accept="image/*" />
        <ul class="list-group" id="list-project_1_image"></ul>
        <div><span class="form-message"></span></div>
        {{-- @if ($errors->has('project_1_image'))
                                    <script>
                                      document.getElementById("project_1_image").classList.add("is-invalid");
                                    </script>
                                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('project_1_image') }}
      </div>
      @endif --}}
    </div>
  </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.project_1_text') }}<span class="text-danger">*</span></label>
      </div>
      <div class="col-sm-9">
        <textarea class="form-control" name="project_1_text" id="project_1_text" placeholder="Nội dung text"
          id="floatingTextarea2" style="height: 100px"></textarea>
        {{-- @if ($errors->has('project_1_text'))
                                      <script>
                                        document.getElementById("project_1_text").classList.add("is-invalid");
                                      </script>
                                      <div class="invalid-feedback" style="display: block;">{{ $errors->first('project_1_text') }}
      </div>
      @endif --}}
      <div><span class="form-message"></span></div>
    </div>
  </div>
  </div>

  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="project_2_title">{{ config('label.artists.project_2_title') }}<span
            class="text-danger">*</span></label>
      </div>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <input type="text" id="project_2_title" class="form-control" name="project_2_title" />
        </div>
        {{-- @if ($errors->has('project_2_title'))
                                      <script>
                                        document.getElementById("project_2_title").classList.add("is-invalid");
                                      </script>
                                      <div class="invalid-feedback" style="display: block;">{{ $errors->first('project_2_title') }}
      </div>
      @endif --}}
      <div><span class="form-message"></span></div>
    </div>
  </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.project_2_image') }} <span class="text-danger">*</span> <span
            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
            500</span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-project_2_image" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="project_2_image" class="form-control hidden" name="project_2_image[]" accept="image/*" />
        <ul class="list-group" id="list-project_2_image"></ul>
        {{-- @if ($errors->has('project_2_image'))
                                      <script>
                                        document.getElementById("project_2_image").classList.add("is-invalid");
                                      </script>
                                      <div class="invalid-feedback" style="display: block;">{{ $errors->first('project_2_image') }}
      </div>
      @endif --}}
      <div><span class="form-message"></span></div>
    </div>
  </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.project_2_text') }}<span class="text-danger">*</span></label>
      </div>
      <div class="col-sm-9">
        <textarea class="form-control" name="project_2_text" id="project_2_text" placeholder="Nội dung text"
          id="floatingTextarea2" style="height: 100px"></textarea>
        {{-- @if ($errors->has('project_2_text'))
                                      <script>
                                        document.getElementById("project_2_text").classList.add("is-invalid");
                                      </script>
                                      <div class="invalid-feedback" style="display: block;">{{ $errors->first('project_2_text') }}
      </div>
      @endif --}}
      <div><span class="form-message"></span></div>
    </div>

  </div>
  </div>

  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="bts_text">{{ config('label.artists.bts_text') }}<span class="text-danger">*</span></label>
      </div>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <input type="text" id="bts_text" class="form-control" name="bts_text" />
        </div>
        {{-- @if ($errors->has('bts_text'))
                                      <script>
                                        document.getElementById("bts_text").classList.add("is-invalid");
                                      </script>
                                      <div class="invalid-feedback" style="display: block;">{{ $errors->first('bts_text') }}
      </div>
      @endif --}}
      <div><span class="form-message"></span></div>
    </div>
  </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="bts_link_fb">{{ config('label.artists.bts_link_fb') }}</label>
      </div>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <input type="text" id="bts_link_fb" class="form-control" name="bts_link_fb" />
        </div>
        @if ($errors->has('bts_link_fb'))
        <script>
        document.getElementById("bts_link_fb").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('bts_link_fb') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="bts_link_ins">{{ config('label.artists.bts_link_ins') }}</label>
      </div>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <input type="text" id="bts_link_ins" class="form-control" name="bts_link_ins" />
        </div>
        @if ($errors->has('bts_link_ins'))
        <script>
        document.getElementById("bts_link_ins").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('bts_link_ins') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="bts_link_tt">{{ config('label.artists.bts_link_tt') }}</label>
      </div>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <input type="text" id="bts_link_tt" class="form-control" name="bts_link_tt" />
        </div>
        @if ($errors->has('bts_link_tt'))
        <script>
        document.getElementById("bts_link_tt").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('bts_link_tt') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="bts_link_yt">{{ config('label.artists.bts_link_yt') }}</label>
      </div>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <input type="text" id="bts_link_yt" class="form-control" name="bts_link_yt" />
        </div>
        @if ($errors->has('bts_link_yt'))
        <script>
        document.getElementById("bts_link_yt").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('bts_link_yt') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="bts_link_sc">{{ config('label.artists.bts_link_sc') }}</label>
      </div>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <input type="text" id="bts_link_sc" class="form-control" name="bts_link_sc" />
        </div>
        @if ($errors->has('bts_link_sc'))
        <script>
        document.getElementById("bts_link_sc").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('bts_link_sc') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.bts_image') }} <span class="text-danger">*</span> <span
            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
            500</span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-bts_image" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="bts_image" class="form-control hidden" name="bts_image[]" accept="image/*" />
        <ul class="list-group" id="list-bts_image"></ul>
        {{-- @if ($errors->has('bts_image'))
                                      <script>
                                        document.getElementById("bts_image").classList.add("is-invalid");
                                      </script>
                                      <div class="invalid-feedback" style="display: block;">{{ $errors->first('bts_image') }}
      </div>
      @endif --}}
      <div><span class="form-message"></span></div>
    </div>
  </div>
  </div>

  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.life_style_1') }} <span
            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
            500</span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-life_style_1" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="life_style_1" class="form-control hidden" name="life_style_1[]" accept="image/*" />
        <ul class="list-group" id="list-life_style_1">

        </ul>
        @if ($errors->has('life_style_1'))
        <script>
        document.getElementById("life_style_1").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('life_style_1') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.life_style_2') }} <span
            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
            500</span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-life_style_2" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="life_style_2" class="form-control hidden" name="life_style_2[]" accept="image/*" />
        <ul class="list-group" id="list-life_style_2">

        </ul>
        @if ($errors->has('life_style_2'))
        <script>
        document.getElementById("life_style_2").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('life_style_2') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.life_style_3') }} <span
            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
            500</span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-life_style_3" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="life_style_3" class="form-control hidden" name="life_style_3[]" accept="image/*" />
        <ul class="list-group" id="list-life_style_3">

        </ul>
        @if ($errors->has('life_style_3'))
        <script>
        document.getElementById("life_style_3").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('life_style_3') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.life_style_4') }} <span
            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
            500</span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-life_style_4" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="life_style_4" class="form-control hidden" name="life_style_4[]" accept="image/*" />
        <ul class="list-group" id="list-life_style_4">

        </ul>
        @if ($errors->has('life_style_4'))
        <script>
        document.getElementById("life_style_4").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('life_style_4') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.life_style_5') }} <span
            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
            500</span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-life_style_5" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="life_style_5" class="form-control hidden" name="life_style_5[]" accept="image/*" />
        <ul class="list-group" id="list-life_style_5">

        </ul>
        @if ($errors->has('life_style_5'))
        <script>
        document.getElementById("life_style_5").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('life_style_5') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group row">
      <div class="col-sm-3 col-form-label font-weight-bold">
        <label for="color">{{ config('label.artists.life_style_6') }} <span
            class="text-danger font-italic d-block w-100">Kích thước ảnh 500 x
            500</span></label>
      </div>
      <div class="col-sm-9">
        <button id="select-life_style_6" class="btn btn-outline-primary mb-1">
          <i data-feather="file"></i> Chọn ảnh
        </button>
        <input type="file" id="life_style_6" class="form-control hidden" name="life_style_6[]" accept="image/*" />
        <ul class="list-group" id="list-life_style_6">

        </ul>
        @if ($errors->has('life_style_6'))
        <script>
        document.getElementById("life_style_6").classList.add("is-invalid");
        </script>
        <div class="invalid-feedback" style="display: block;">
          {{ $errors->first('life_style_6') }}</div>
        @endif
      </div>
    </div>
  </div>


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
{{-- number input --}}
<script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
{{-- <script type="text/javascript" src="./js/fontend/validator.js"></script> --}}
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('profile');
CKEDITOR.replace('project_1_text');
CKEDITOR.replace('project_2_text');

$(document).ready(function() {

  function string_to_slug(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to = "aaaaeeeeiiiioooouuuunc------";
    for (var i = 0, l = from.length; i < l; i++) {
      str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
      .replace(/\s+/g, '-') // collapse whitespace and replace by -
      .replace(/-+/g, '-'); // collapse dashes

    return str;
  }

  var slugValue = "";

  $("#name").on('change', function() {
    const currentValue = $(this).val();
    slugValue = string_to_slug(currentValue);
    $("#slug").val(slugValue);
  });

  $('#select-images').click(function() {
    $('#images').click()
    return false
  })
  $('#images').change(function() {
    var html = ''
    if (this.files.length > 0) {
      // console.log(this.files);
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-images').html(html)
    }
  })

  //banner
  $('#select-banner').click(function() {
    $('#banner').click()
    return false
  })
  $('#banner').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-banner').html(html)
    }
  })

  //clubs
  $('#select-clubs').click(function() {
    $('#clubs').click()
    return false
  })
  $('#clubs').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-clubs').html(html)
    }
  })

  //partners
  $('#select-partners').click(function() {
    $('#partners').click()
    return false
  })
  $('#partners').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-partners').html(html)
    }
  })

  //project_1_image
  $('#select-project_1_image').click(function() {
    $('#project_1_image').click()
    return false
  })
  $('#project_1_image').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-project_1_image').html(html)
    }
  })

  //project_2_image
  $('#select-project_2_image').click(function() {
    $('#project_2_image').click()
    return false
  })
  $('#project_2_image').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-project_2_image').html(html)
    }
  })

  //bts_image
  $('#select-bts_image').click(function() {
    $('#bts_image').click()
    return false
  })
  $('#bts_image').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-bts_image').html(html)
    }
  })

  //life_style_1
  $('#select-life_style_1').click(function() {
    $('#life_style_1').click()
    return false
  })
  $('#life_style_1').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-life_style_1').html(html)
    }
  })

  //life_style_2
  $('#select-life_style_2').click(function() {
    $('#life_style_2').click()
    return false
  })
  $('#life_style_2').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-life_style_2').html(html)
    }
  })

  //life_style_3
  $('#select-life_style_3').click(function() {
    $('#life_style_3').click()
    return false
  })
  $('#life_style_3').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-life_style_3').html(html)
    }
  })

  //life_style_4
  $('#select-life_style_4').click(function() {
    $('#life_style_4').click()
    return false
  })
  $('#life_style_4').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-life_style_4').html(html)
    }
  })

  //life_style_5
  $('#select-life_style_5').click(function() {
    $('#life_style_5').click()
    return false
  })
  $('#life_style_5').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-life_style_5').html(html)
    }
  })

  //life_style_6
  $('#select-life_style_6').click(function() {
    $('#life_style_6').click()
    return false
  })
  $('#life_style_6').change(function() {
    var html = ''
    if (this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-life_style_6').html(html)
    }
  })


  function uploadFile(file) {
    var _token = $("input[name='_token']").val();
    var formData = new FormData()
    var res = ''
    formData.append('_token', _token)
    formData.append('image', file)

    $.ajax({
      url: "{{ route('artists.handlerImage') }}",
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
        var link = "{{ URL::to('/') }}" + data.urlImg
        var range = snowEditor.getSelection();

        // console.log('User trying to uplaod this:', link);
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
  // Mong muốn của chúng ta
  Validator({
    form: '#main-form',
    formGroupSelector: '.form-group',
    errorSelector: '.form-message',
    rules: [
      Validator.isRequired('#name', "vui lòng nhập họ tên !"),
      // Validator.isRequired('#profile', "vui lòng nhập nội dung profile !"),
      Validator.isRequired('#project_1_title', "vui lòng nhập title project 1 !"),
      // Validator.isRequired('#project_1_text', "vui lòng nhập nội dung project 1 !"),
      Validator.isRequired('#project_2_title', "vui lòng nhập title project 2 !"),
      // Validator.isRequired('#project_2_text', "vui lòng nhập nội dung project 2 !"),
      Validator.isRequired('#bts_text', "vui lòng nhập BTS title !"),
      // Validator.isRequired('#name', "Vui lòng nhập nội dung profile !"),
      // Validator.isRequired('#name', "Vui lòng nhập nội dung profile !"),
      // Validator.isRequired('#images', "vui lòng chọn hình ảnh !"),
      Validator.isRequired('#banner', "vui lòng chọn ảnh banner!"),
      Validator.isRequired('#project_1_image', "vui lòng chọn hình ảnh project 1 !"),
      Validator.isRequired('#project_2_image', "vui lòng chọn hình ảnh project 2!"),
      Validator.isRequired('#bts_image', "vui lòng chọn  BTS hình ảnh!"),
      Validator.isRequired('#images', "vui lòng chọn hình ảnh!"),
      Validator.minLength('#name', 2)
    ],
    onSubmit: function(data) {
      // $('#main-form').submit()
      // console.log(data);
    }
  });
});
</script>

@endsection