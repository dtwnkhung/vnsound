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
        <form class="form-horizontal form" id="main-form" action="{{ route('components.update', $item->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
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
                            value="{{$item->title}}"
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
                  <label for="slug">Slug</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="slug"
                            class="form-control "
                            name="slug"
                            value="{{$item->slug}}"
                            disabled
                    />
                  </div>
                  @if ($errors->has('slug'))
                    <script>
                      document.getElementById("slug").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('slug') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="link">Link</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="link"
                            class="form-control"
                            name="link"
                            value="{{$item->link}}"
                    />
                  </div>
                  @if ($errors->has('link'))
                    <script>
                      document.getElementById("link").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('link') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="color">{{ config('label.products.images') }}</label>
                </div>
                <div class="col-sm-9">
                  <button id="select-images" class="btn btn-outline-primary mb-1">
                    <i data-feather="file"></i> Chọn ảnh
                  </button>
                  <input type="file" id="image" class="form-control hidden" name="image[]"/>

                  <div class="row" id="images">
                    @foreach ($item->images as $img)
                      <div class="col-4">
                        <img src="{{ URL::to('/images/components'). '/1600x400-' .$img }} " alt="" width="100%">
                      </div>
                    @endforeach
                  </div>
                  <ul class="list-group" id="list-images">
                  </ul>
                  @if ($errors->has('image'))
                    <script>
                      document.getElementById("image").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('image') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="color">File</label>
                </div>
                <div class="col-sm-9">
                  <button id="select-files" class="btn btn-outline-primary mb-1">
                    <i data-feather="file"></i> Chọn file
                  </button>
                  <input type="file" id="files" class="form-control hidden" name="files"/>

                  <div class="row" id="images">
                  </div>
                  @if (count($item->files) > 0)
                    <ul class="list-group" id="list-files">
                      @foreach ($item->files as $file)
                        <li class="list-group-item list-group-item-action list-group-item-success">{{ $file }}</li>
                      @endforeach
                    </ul>
                  @endif
                  @if ($errors->has('files'))
                    <script>
                      document.getElementById("files").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('files') }}</div>
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
                  <textarea class="form-control" name="description" id="description" placeholder="Nội dung text" id="floatingTextarea2"
                            style="height: 100px">{{$item->description}}</textarea>

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
      $('#select-images').click(function () {
        $('#image').click()
        return false
      })
      $('#select-files').click(function () {
        $('#files').click()
        return false
      })
      $('#image').change(function () {
        $('#images').html('')
        var html = ''
        if(this.files.length > 0){
          for(let i=0;i<this.files.length;i++){
            html += '<li class="list-group-item list-group-item-action list-group-item-success">'+this.files[i].name+'('+this.files[i].size+'B)</li>'
          }
          $('#list-images').html(html)
        }
      })

      $('#files').change(function () {
        $('#files').html('')
        var html = ''
        if(this.files.length > 0){
          for(let i=0;i<this.files.length;i++){
            html += '<li class="list-group-item list-group-item-action list-group-item-success">'+this.files[i].name+'('+this.files[i].size+'B)</li>'
          }
          $('#list-files').html(html)
        }
      })

      function uploadFile(file) {
        var _token = $("input[name='_token']").val();
        var formData = new FormData()
        var res = ''
        formData.append('_token', _token)
        formData.append('image', file)

        $.ajax({
          url: "{{ route('components.handlerImage') }}",
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
