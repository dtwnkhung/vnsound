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
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
  <style>
    .ql-editor{
      min-height:200px;
    }
    image{
      max-width: 100%;
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
      <form class="form-horizontal form" id="main-form" action="{{ route('achievements.store') }}" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="row">
          <div class="col-12">
            <div class="form-group row">
              <div class="col-sm-3 col-form-label font-weight-bold">
                <label for="title">Tiêu đề</label>
              </div>
              <div class="col-sm-9">
                <div class="input-group input-group-merge">
                  <input
                          type="text"
                          id="title"
                          class="form-control"
                          name="title"
                  />
                </div>
                @if ($errors->has('title'))
                  <script>
                    document.getElementById("title").classList.add("is-invalid");
                  </script>
                  <div class="invalid-feedback" style="display: block;">{{ $errors->first('title') }}</div>
                @endif
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <div class="col-sm-3 col-form-label font-weight-bold">
                <label for="color">Hình ảnh<span class="text-danger">*</span></label>
              </div>
              <div class="col-sm-9">
                <button id="select-files" class="btn btn-outline-primary mb-1">
                  <i data-feather="file"></i> Chọn ảnh
                </button>
                <input type="file" id="images" class="form-control hidden" name="images[]"/>
                <ul class="list-group" id="list-images">

                </ul>
                @if ($errors->has('images'))
                  <script>
                    document.getElementById("images").classList.add("is-invalid");
                  </script>
                  <div class="invalid-feedback" style="display: block;">{{ $errors->first('images') }}</div>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-9 offset-sm-3">
            <button type="button" class="btn btn-primary mr-1" id="submitForm">Lưu</button>
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
  <script>
      $(document).ready(function(){
        $('#select-files').click(function () {
          $('#images').click()
          return false
        })
        $('#images').change(function () {
          var html = ''
          if(this.files.length > 0){
            for(let i=0;i<this.files.length;i++){
              html += '<li class="list-group-item list-group-item-action list-group-item-success">'+this.files[i].name+'('+this.files[i].size+'B)</li>'
            }
            $('#list-images').html(html)
          }
        })
        $('#select-image-mobile').click(function () {
          $('#image_mobile').click()
          return false
        })
        $('#image_mobile').change(function () {
          var html = ''
          if(this.files.length > 0){
            for(let i=0;i<this.files.length;i++){
              html += '<li class="list-group-item list-group-item-action list-group-item-success">'+this.files[i].name+'('+this.files[i].size+'B)</li>'
            }
            $('#list-image_mobile').html(html)
          }
        })

        $('#submitForm').click(function () {
          $('#main-form').submit()
        })

        var numeralMask = $('.numeral-mask');
        //Numeral
        if (numeralMask.length) {
          $('.numeral-mask').each(function(){
            new Cleave(this, {
              numeral: true,
              numeralThousandsGroupStyle: 'thousand'
            });
          })
        }
      })
  </script>

@endsection
