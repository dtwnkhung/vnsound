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
        <form class="form-horizontal form" id="main-form" action="{{ route('contacts.update', $item->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="row">
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="name">Họ và tên<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="name"
                            class="form-control"
                            name="name"
                            value="{{$item->name}}"
                            disabled
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
                  <label for="email">Email<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="email"
                            class="form-control"
                            name="email"
                            value="{{$item->email}}"
                            disabled
                    />
                  </div>
                  @if ($errors->has('email'))
                    <script>
                      document.getElementById("email").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('email') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="contents">Nội dung liên hệ<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group input-group-merge">
                    <input
                            type="text"
                            id="contents"
                            class="form-control"
                            name="contents"
                            value="{{$item->contents}}"
                            disabled
                    />
                  </div>
                  @if ($errors->has('contents'))
                    <script>
                      document.getElementById("contents").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('contents') }}</div>
                  @endif
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="status">Trạng thái<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <select class="select2 form-control form-control-lg is-invalid" name="status" id="status">
                    <option>-- Lựa chọn --</option>
                    @if($item->status == 0)
                      <option value="0" selected>Chưa liên hệ</option>
                      <option value="1">Đã liên hệ</option>
                    @else
                      <option value="0" >Chưa liên hệ</option>
                      <option value="1" selected>Đã liên hệ</option>
                    @endif
                  </select>
                  @if ($errors->has('status'))
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('status') }}</div>
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
        $('#image').click()
        return false
      })
      $('#image').change(function () {
        $('#images').html('')
        var html = ''
        if(this.files.length > 0){
          console.log(this.files);
          for(let i=0;i<this.files.length;i++){
            html += '<li class="list-group-item list-group-item-action list-group-item-success">'+this.files[i].name+'('+this.files[i].size+'B)</li>'
          }
          $('#list-images').append(html)
        }
      })
      function uploadFile(file) {
        var _token = $("input[name='_token']").val();
        var formData = new FormData()
        var res = ''
        formData.append('_token', _token)
        formData.append('image', file)

        $.ajax({
          url: "{{ route('contacts.handlerImage') }}",
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

      var numeralMask = $('.numeral-mask');
      //Numeral
      if (numeralMask.length) {
        new Cleave(numeralMask, {
          numeral: true,
          numeralThousandsGroupStyle: 'thousand'
        });
      }
    })
  </script>

@endsection
