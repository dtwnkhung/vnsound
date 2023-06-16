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
        <form class="form-horizontal form" id="main-form" action="{{ route('teachers.update', $user->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="row">
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="name">{{ config('label.teachers.name') }}<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="name"
                            class="form-control"
                            name="name"
                            value="{{ $user->name }}"
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
                  <label for="name">{{ config('label.teachers.email') }}<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="email"
                            class="form-control"
                            name="email"
                            disabled
                            value="{{ $user->email }}"
                    />
                  </div>
                  @if ($errors->has('email'))
                    <script>
                      document.getElementById("name").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('email') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="name">{{ config('label.teachers.date_of_birth') }}</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="date_of_birth"
                            class="form-control"
                            name="date_of_birth"
                            value="{{ $user->date_of_birth }}"
                    />
                  </div>
                  @if ($errors->has('date_of_birth'))
                    <script>
                      document.getElementById("name").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('date_of_birth') }}</div>
                  @endif
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="class">Lớp học đăng ký dạy<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <select class="select2 form-control form-control-lg is-invalid" name="class" id="class">
                    @foreach($classes as $class)
                      @if($class->id == $user->class)
                        <option value="{{ $class->id }}" selected>{{ $class->name }}</option>
                      @else
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                      @endif
                    @endforeach
                  </select>
                  @if ($errors->has('class'))
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('class') }}</div>
                  @endif
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="name">{{ config('label.teachers.address') }}</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="address"
                            class="form-control"
                            name="address"
                            value="{{ $user->address }}"
                    />
                  </div>
                  @if ($errors->has('address'))
                    <script>
                      document.getElementById("name").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('address') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="name">{{ config('label.teachers.link') }}</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="link"
                            class="form-control"
                            name="link"
                            value="{{ $user->link }}"
                    />
                  </div>
                  @if ($errors->has('link'))
                    <script>
                      document.getElementById("name").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('link') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="name">{{ config('label.teachers.education') }}</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="education"
                            class="form-control"
                            name="education"
                            value="{{ $user->education }}"
                    />
                  </div>
                  @if ($errors->has('education'))
                    <script>
                      document.getElementById("name").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('education') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="name">{{ config('label.teachers.experience') }}</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="experience"
                            class="form-control"
                            name="experience"
                            value="{{ $user->experience }}"
                    />
                  </div>
                  @if ($errors->has('experience'))
                    <script>
                      document.getElementById("name").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('experience') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="name">{{ config('label.teachers.english') }}</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="english"
                            class="form-control"
                            name="english"
                            value="{{ $user->english }}"
                    />
                  </div>
                  @if ($errors->has('english'))
                    <script>
                      document.getElementById("name").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('english') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="color">{{ config('label.teachers.certificate') }}</label>
                </div>
                <div class="col-sm-9">
                  <button id="select-certificate" class="btn btn-outline-primary mb-1">
                    <i data-feather="file"></i> Chọn ảnh
                  </button>
                  <input type="file" id="certificate" class="form-control hidden" name="certificate[]" multiple />
                  <div class="row" id="certificate">
                    @foreach ($user->certificate as $img)
                      <div class="col-2">
                        <img src="{{ URL::to('/images/teachers'). '/400x400-' .$img }} " alt="" width="100%">
                      </div>
                    @endforeach
                  </div>
                  <ul class="list-group mt-1" id="list-certificate">

                  </ul>
                  @if ($errors->has('certificate'))
                    <script>
                      document.getElementById("certificate").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('certificate') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="color">{{ config('label.teachers.images') }}<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <button id="select-files" class="btn btn-outline-primary mb-1">
                    <i data-feather="file"></i> Chọn ảnh
                  </button>
                  <input type="file" id="images" class="form-control hidden" name="images[]" />
                  <div class="row" id="images">
                    @foreach ($user->images as $img)
                      <div class="col-2">
                        <img src="{{ URL::to('/images/teachers'). '/400x400-' .$img }} " alt="" width="100%">
                      </div>
                    @endforeach
                  </div>
                  <ul class="list-group mt-1" id="list-images">

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
      $('#select-files').click(function () {
        $('#images').click()
        return false
      })
      $('#images').change(function () {
        var html = ''
        if(this.files.length > 0){
          console.log(this.files);
          for(let i=0;i<this.files.length;i++){
            html += '<li class="list-group-item list-group-item-action list-group-item-success">'+this.files[i].name+'('+this.files[i].size+'B)</li>'
          }
          $('#list-images').html(html)
        }
      })
      $('#select-certificate').click(function () {
        $('#certificate').click()
        return false
      })
      $('#certificate').change(function () {
        var html = ''
        if(this.files.length > 0){
          console.log(this.files);
          for(let i=0;i<this.files.length;i++){
            html += '<li class="list-group-item list-group-item-action list-group-item-success">'+this.files[i].name+'('+this.files[i].size+'B)</li>'
          }
          $('#list-certificate').html(html)
        }
      })
      function uploadFile(file) {
        var _token = $("input[name='_token']").val();
        var formData = new FormData()
        var res = ''
        formData.append('_token', _token)
        formData.append('image', file)

        $.ajax({
          url: "{{ route('teachers.handlerImage') }}",
          type:'POST',
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

      $('#submitForm').click(function () {
        $('#main-form').submit()
      })

    })
  </script>

@endsection
