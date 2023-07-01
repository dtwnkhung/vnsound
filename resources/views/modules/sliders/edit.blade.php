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
        <form class="form-horizontal form" id="main-form" action="{{ route('sliders.update', $item->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="row">
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="title">Tên album<span class="text-danger">*</span></label>
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
                  <label for="color">Ảnh đại diện album<span class="text-danger">*</span></label>
                  {{-- <label for="color">{{ config('label.products.images') }}</label> --}}
                </div>
                <div class="col-sm-9">
                  <button id="select-files" class="btn btn-outline-primary mb-1">
                    <i data-feather="file"></i> Chọn ảnh
                  </button>
                  <input type="file" id="images_key" class="form-control hidden" name="images_key[]"/>

                  <div class="row" id="images_key">
                    @foreach ($item->images_key as $img)
                      <div class="col-4">
                        <img src="{{ URL::to('/images/slider_key'). '/1600x400-' .$img }} " alt="" width="100%">
                      </div>
                    @endforeach
                  </div>
                  <ul class="list-group" id="list-images">
                  </ul>
                  @if ($errors->has('images_key'))
                    <script>
                      document.getElementById("images_key").classList.add("is-invalid");
                    </script>
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('images_key') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="color">Hình ảnh khác<span class="text-danger">*</span></label>
                  {{-- <label for="color">{{ config('label.products.images') }}</label> --}}
                </div>
                <div class="col-sm-9">
                  <button id="select-files_2" class="btn btn-outline-primary mb-1">
                    <i data-feather="file"></i> Chọn ảnh
                  </button>
                  <input type="file" id="images" class="form-control hidden" name="images[]" multiple accept="image/*" />

                  <div class="row" id="images">
                    @foreach ($item->images as $img)
                      <div class="col-4">
                        <img src="{{ URL::to('/images/sliders'). '/1600x400-' .$img }} " alt="" width="100%">
                      </div>
                    @endforeach
                  </div>
                  <ul class="list-group" id="list-images_2">
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
            {{-- <div class="col-12">
              <div class="form-group row">
                <div class="col-sm-3 col-form-label font-weight-bold">
                  <label for="type">Phân loại<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                  <select class="select2 form-control form-control-lg is-invalid" name="type" id="type">
                    <option>-- Lựa chọn --</option>
                    @switch($item->type)
                        @case('1')
                            @php $selected_1 = "selected" @endphp
                            @break
                        @case('2')
                            @php $selected_2 = "selected" @endphp
                            @break
                        @case('3')
                            @php $selected_3 = "selected" @endphp
                            @break
                        @case('4')
                            @php $selected_4 = "selected" @endphp
                            @break
                        @case('5')
                            @php $selected_5 = "selected" @endphp
                            @break
                        @case('6')
                            @php $selected_6 = "selected" @endphp
                            @break
                        @case('7')
                            @php $selected_7 = "selected" @endphp
                            @break
                        @case('9')
                            @php $selected_9 = "selected" @endphp
                            @break
                        @default
                            @php $selected_8 = "selected" @endphp
                    @endswitch
                    <option value="1" @php echo (isset($selected_1) ? $selected_1 : "" ) @endphp>MC</option>
                    <option value="2" @php echo (isset($selected_2) ? $selected_2 : "" ) @endphp>DJ</option>
                    <option value="3" @php echo (isset($selected_3) ? $selected_3 : "" ) @endphp>PRODUCER</option>
                    <option value="4" @php echo (isset($selected_4) ? $selected_4 : "" ) @endphp>MKT</option>
                    <option value="5" @php echo (isset($selected_5) ? $selected_5 : "" ) @endphp>Sự Kiện</option>
                    <option value="7" @php echo (isset($selected_7) ? $selected_7 : "" ) @endphp>STUDIO</option>
                    <option value="8" @php echo (isset($selected_8) ? $selected_8 : "" ) @endphp>WORKSHOP</option>
                    <option value="9" @php echo (isset($selected_9) ? $selected_9 : "" ) @endphp>PROFILE</option>
                    <option value="6" @php echo (isset($selected_6) ? $selected_6 : "" ) @endphp>Khác</option>
                  </select>
                  @if ($errors->has('type'))
                    <div class="invalid-feedback" style="display: block;">{{ $errors->first('type') }}</div>
                  @endif
                </div>
              </div>
            </div> --}}
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
        $('#images_key').click()
        return false
      })
      $('#images_key').change(function () {
        $('#images_key').html('')
        var html = ''
        if(this.files.length > 0){
          for(let i=0;i<this.files.length;i++){
            html += '<li class="list-group-item list-group-item-action list-group-item-success">'+this.files[i].name+'('+this.files[i].size+'B)</li>'
          }
          $('#list-images').html(html)
        }
      })

      $('#select-files_2').click(function () {
        $('#images').click()
        return false
      })
      $('#images').change(function () {
        $('#images').html('')
        var html = ''
        if(this.files.length > 0){
          for(let i=0;i<this.files.length;i++){
            html += '<li class="list-group-item list-group-item-action list-group-item-success">'+this.files[i].name+'('+this.files[i].size+'B)</li>'
          }
          $('#list-images_2').html(html)
        }
      })

      $('#select-image_mobile').click(function () {
        $('#image_mobile').click()
        return false
      })
      $('#image_mobile').change(function () {
        $('#image_mobile').html('')
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
