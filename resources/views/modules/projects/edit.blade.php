@extends('layouts/contentLayoutMaster')

@section('title', 'Chỉnh sửa')

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
        <form class="form-horizontal form" id="main-form" action="{{ route('projects.update', $item->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="row">
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="name">Tên sự kiện</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="name"
                            class="form-control"
                            name="name"
                            value="{{$item->name}}"
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
                  <label for="color">Nội dung</label>
                </div>
                <div class="col-sm-9">
                  <input type="hidden" name="description" id="description">
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="snow-wrapper">
                        <div id="snow-container">
                          <div class="quill-toolbar">
                          <span class="ql-formats">
                      <select class="ql-header">
                        <option value="1">Heading</option>
                        <option value="2">Subheading</option>
                        <option selected>Normal</option>
                      </select>
                    </span>
                            <span class="ql-formats">
                      <button class="ql-bold"></button>
                      <button class="ql-italic"></button>
                      <button class="ql-underline"></button>
                    </span>
                            <span class="ql-formats">
                      <button class="ql-list" value="ordered"></button>
                      <button class="ql-list" value="bullet"></button>
                    </span>
                            <span class="ql-formats">
                      <button class="ql-link"></button>
                      <button class="ql-image"></button>
                      <button class="ql-video"></button>
                    </span>
                            <span class="ql-formats">
                      <button class="ql-formula"></button>
                      <button class="ql-code-block"></button>
                    </span>
                            <span class="ql-formats">
                      <button class="ql-clean"></button>
                    </span>
                          </div>
                          <div class="editor">
                            {!! $item->description !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="color">Hình Thumbnail<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <button id="select-thumbnail" class="btn btn-outline-primary mb-1">
                    <i data-feather="thumbnail"></i> Chọn ảnh
                  </button>
                  <input type="file" id="thumbnail" class="form-control hidden" name="thumbnail[]" />
                  <div class="row" id="thumbnails">
                    @foreach ($item->thumbnail as $img)
                      <div class="col-4">
                        <img src="{{ URL::to('/images/projects'). '/' .$img }} " alt="" width="100%">
                      </div>
                    @endforeach
                  </div>
                  <ul class="list-group" id="list-thumbnail">

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

            <div class="col-sm-9 offset-sm-3">
              <button type="reset" class="btn btn-primary mr-1" id="submitForm">Submit</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
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
      function uploadFile(file) {
        var _token = $("input[name='_token']").val();
        var formData = new FormData()
        var res = ''
        formData.append('_token', _token)
        formData.append('image', file)

        $.ajax({
          url: "{{ route('news.handlerImage') }}",
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
      // quill Editor
      var snowEditor = new Quill('#snow-container .editor', {
        bounds: '#snow-container .editor',
        modules: {
          toolbar: {
            container: '#snow-container .quill-toolbar',
            handlers: {
              'image': imageHandler
            }
          }
        },
        theme: 'snow',
      });
      $('#submitForm').click(function () {
        $('.ql-hidden').remove()
        $('#description').val(snowEditor.container.innerHTML)
        $('#main-form').submit()
      })
    })
  </script>

@endsection
