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

  <link rel="stylesheet" type="text/css"  href="{{ asset(mix('vendors/css/vendors.min.css')) }}">
  <link rel="stylesheet" type="text/css"  href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" type="text/css"  href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
  <style>
    .ql-editor{
      min-height:200px;
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
        <form class="form-horizontal form" id="main-form" action="{{ route('students.updateRepresentativeStudent', $item->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="row">
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="name">{{ config('label.students.name') }}<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="name"
                            class="form-control"
                            name="name"
                            value="{{ $item->name }}"
                    />
                  </div>
                  @if ($errors->has('name'))
                    <script>
                      document.getElementById("name").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('name') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="color">{{ config('label.students.thumbnail') }}<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <button id="select-thumbnail" class="btn btn-outline-primary mb-1">
                    <i data-feather="file"></i> Chọn ảnh
                  </button>
                  <input type="file" id="thumbnail" class="form-control hidden" name="thumbnail[]" />
                  <div class="row" id="thumbnail">
                    @foreach ($item->thumbnail as $img)
                      <div class="col-2">
                        <img src="{{ URL::to('/images/students'). '/' .$img }} " alt="" width="100%">
                      </div>
                    @endforeach
                  </div>
                  <ul class="list-group mt-1" id="list-thumbnail">

                  </ul>
                  @if ($errors->has('thumbnail'))
                    <script>
                      document.getElementById("thumbnail").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('thumbnail') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="class_id">{{ config('label.students.class_id') }}<span class="text-danger">*</span></label>
                </div>
  
                <div class="col-sm-9">
                  <select class="select2 form-control form-control-lg is-invalid" name="class_id" id="class_id">
                    @foreach($prodcuts as $key => $item)
                      <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('class_id'))
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('class_id') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="comments">{{ config('label.students.comments') }}</label>
                </div>
                <div class="col-sm-9">
                  <textarea class="form-control" name="comments" id="comments" placeholder="Nội dung text" id="floatingTextarea2"
                            style="height: 100px">{{ $item['comments'] }}
                          </textarea>
                  @if ($errors->has('description'))
                    <script>
                      document.getElementById("description").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('description') }}</div>
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

  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}" ></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}" ></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}" ></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}" ></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}" ></script>

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
      $('#date_of_birth').flatpickr();
        $('#select-thumbnail').click(function () {
          $('#thumbnail').click()
          return false
        })
      $('#thumbnail').change(function () {
        var html = ''
        if(this.files.length > 0){
          for(let i=0;i<this.files.length;i++){
            html += '<li class="list-group-item list-group-item-action list-group-item-success">'+this.files[i].name+'('+this.files[i].size+'B)</li>'
          }
          $('#list-thumbnail').html(html)
        }
      })

      $('#submitForm').click(function () {
        $('#main-form').submit()
      })

    })
  </script>

@endsection
