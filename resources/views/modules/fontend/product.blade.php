@extends('modules.fontend.layout.index')
@section('facebook_meta')
<meta property="og:image" content="{{ URL::to('/images/products'). '/'. $itemSlug['block_2_image']}}" />
@endsection
@section('content')
<!--Section: Block Content-->
<style>
  #html-convert_4 p {
    background: none
  }

  .text-artist-intro * {
    padding: 0 !important
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


<div class="vnsound_banner banner_introduct banner_khartist">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner_content">
          <h1 class="banner_title wow fadeInUp animated">
            {{ $itemSlug['name'] }}
          </h1>
          <div class="banner_txt wow fadeInUp animated" data-wow-delay="0.3s">
            {{ $itemSlug['sub_name'] }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="detaiartist_welcome khartist_welcome">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="welcome_content">
          <div class="welcome_left">
            {{-- <img src="images/img-welcom1.png" alt="" /> --}}
            <img src="{{ URL::to('/images/products'). '/'. $itemSlug['images_artist']}}" alt="" />
            <img src="images/img-welcom2.png" alt="" style="display: block;margin: 35px auto 0;" />
          </div>
          <div class="welcome_right">
            <div class="welcome_right_content">
              <div class="welcome_right_title">
                {{ $itemSlug['name_artist'] }}
              </div>
              <div class="mttn_left_txt text-artist-intro" id="html-convert_4">
                {{ $itemSlug['profile_artist'] }}
              </div>
              <div class="welcome_right_box">
                <!-- <a href="javascript:void(0)" class="btn welcome_right_btn" data-toggle="modal"
                  data-target="#proj_follow">
                  Liên hệ với tôi
                </a> -->
                <a href="http://m.me/vnsoundstudio" class="btn welcome_right_btn" target="_blank">
                  Liên hệ với tôi
                </a>
                <!-- <a href="javascript:void(0)" class="welcome_right_links">
                                    Follow me*
                                </a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="introduct_mttn khartist_mttn">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="mttn_row mttn_row2">
          <div class="row">
            <div class="col-md-6">
              <div class="mttn_left">
                <h3 class="mttn_left_title">
                  {{ $itemSlug['block_1_title'] }}
                </h3>
                <div class="mttn_left_txt" id="html-convert_1">
                  {{ $itemSlug['block_1_content'] }}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated animated animated"
                style="visibility: visible; animation-name: flipInY;">
                <img src="{{ URL::to('/images/products'). '/'. $itemSlug['block_1_image']}}" />
              </div>
            </div>
          </div>
        </div>
        <div class="mttn_row">
          <div class="row">
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated animated animated"
                style="visibility: visible; animation-name: flipInY;">
                <img src="{{ URL::to('/images/products'). '/'. $itemSlug['block_2_image']}}" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_left">
                <h3 class="mttn_left_title">
                  {{ $itemSlug['block_2_title'] }}
                </h3>
                <div class="mttn_left_txt" id="html-convert_2">
                  {{ $itemSlug['block_2_content'] }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mttn_row mttn_row2">
          <div class="row">
            <div class="col-md-6">
              <div class="mttn_left">
                <h3 class="mttn_left_title">
                  {{ $itemSlug['block_3_title'] }}
                </h3>
                <div class="mttn_left_txt" id="html-convert_3">
                  {{ $itemSlug['block_3_content'] }}
                </div>
                <div class="khartist_box_btn">
                  <!-- <a href="javascript:void(0)" class="btn btn_khartist" data-toggle="modal" data-target="#proj_follow">
                                        Đăng ký ngay
                                    </a> -->
                  <a href="http://m.me/vnsoundstudio" class="btn btn_khartist" target="_blank">
                    Đăng ký ngay
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated animated animated"
                style="visibility: visible; animation-name: flipInY;">
                <img src="{{ URL::to('/images/products'). '/'. $itemSlug['block_3_image']}}" />
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="vnsound_outstanding position-relative">
  <img class="img-nst6 wow fadeInLeft" data-wow-duration="1.5s" src="images/nha-sang-tao/img-nst6.png" alt=""
    style="position:absolute;top:0;left:0" />
  <img class="img-nst7 wow fadeInRight" data-wow-duration="1.5s" src="images/nha-sang-tao/img-nst7.png"
    style="position:absolute;bottom:0;right:0" alt="" />
  <div class="container position-relative" style="z-index:5">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <!-- <div class="vnsound_title_bg d-none wow slideInUp animated">
                        ý kiến học viên
                    </div> -->
          <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
            ý kiến học viên
          </h2>
        </div>
        <div class="artists_list outstanding_content mb-4">
          <div class="swiper-container outstanding_slide ">
            <div class="slider-nav">
              @foreach ($students as $itemSlugs)
              <div class="swiper-slide">
                <div class="outstanding_item">
                  <div class="outstanding_item_img">
                    <span>
                      <img src="{{ URL::to('/images/students'). '/'. $itemSlugs['thumbnail']}}"
                        style="height:100%;object-fit:cover" />
                    </span>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>

          <div class="swiper-container outstanding_slide mt-3">
            <div class="text-center"><img src="images/ic-13.png" alt="" /></div>
            <div class="slider-for">
              @foreach ($students as $itemSlugs)
              <div class="swiper-slide">
                <div class="outstanding_item">
                  <div class="outstanding_item_slide d-block">
                    <div class="outstanding_txt_top">
                      {{ $itemSlugs['opinion'] }}
                    </div>
                    <div class="outstanding_txt_bot">
                      <span>
                        {{ $itemSlugs['name'] }}
                      </span>
                      {{ $itemSlugs->getclass->name }}
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <!-- <div class="outstanding_txt">
          <img src="images/ic-13.png" alt="" />
          <div class="outstanding_txt_content">
            <div class="outstanding_txt_top">
              Mình cảm ơn VNsound rất nhiều, đây là một môi trường làm việc rất tốt và năng động
            </div>
            <div class="outstanding_txt_bot">
              <span>
                Nguyễn Đình Hoàng
              </span>
              Học viên khóa k03
            </div>
          </div>
        </div> -->
        <div class="opinion_bot_list">
          <div class="row">
            <div class="col-md-4">
              <div class="opinion_bot_item">
                <div class="opinion_bot_title">
                  LILBEE CLASS
                </div>
                <div class="opinion_bot_money">
                  {{ $itemSlug['free_price'] }}
                </div>
                <div class="opinion_bot_body">
                  <div class="mttn_left_txt">
                    @foreach ($itemSlug['free_benefit'] as $profit)
                    <p>
                      {{ $profit }}
                    </p>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="opinion_bot_item">
                <div class="opinion_bot_title">
                  QUÂN K CLASS
                </div>
                <div class="opinion_bot_money">
                  {{ $itemSlug['basic_price'] }}
                </div>
                <div class="opinion_bot_body">
                  <div class="mttn_left_txt">
                    @foreach ($itemSlug['basic_benefit'] as $profit)
                    <p>
                      {{ $profit }}
                    </p>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="opinion_bot_item">
                <div class="opinion_bot_title">
                  QUÂN K & LILBEE CLASS
                </div>
                <div class="opinion_bot_money">
                  {{ $itemSlug['premium_price'] }}
                </div>
                <div class="opinion_bot_body">
                  <div class="mttn_left_txt">
                    @foreach ($itemSlug['pre_benefit'] as $profit)
                    <p>
                      {{ $profit }}
                    </p>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="introduct_mttn khartist_form">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="mttn_left">
          <h3 class="mttn_left_title">
            Đăng ký ngay với chúng tôi để
          </h3>
          <div class="mttn_left_txt">
            <p>
              Tìm hiểu chi tiết thông tin về khóa học MC Hype/DJ tại VNSound Studio
            </p>
            <p>
              Bắt đầu con đường ngắn nhất để trở thành DJ và MC Hype chuyên nghiệp
            </p>
            <p>
              Gia nhập cộng đồng các bạn trẻ cùng đam mê và kết nối với những DJ, MC Hype đã có kinh nghiệm trong nghề
            </p>
          </div>
          <div class="khartist_box_btn">
            <!-- <a href="javascript:void(0)" class="btn btn_khartist">
                            Đăng ký ngay
                        </a> -->
            <a href="http://m.me/vnsoundstudio" class="btn btn_khartist" target="_blank">
              Đăng ký ngay
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="khartist_form_right">
          <div class="form_title">
            Liên hệ với chúng tôi
          </div>
          <form id="contactForm" action="{{ route(" home.addLienhe") }}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form_content">
              <div class="form_row">
                <input type="hidden" name="id" class="input_control" value="{{$itemSlug['id']}}" />
                <input type="text" name="name" class="input_control" placeholder="Họ và tên"
                  value="{{ old('name') }}" />
                @if ($errors->has('name'))
                <script>
                  document.getElementById("name").classList.add("is-invalid");
                </script>
                <div class="invalid-feedback" style="display: block;">{{ $errors->first('name') }}</div>
                @endif
              </div>
              <div class="form_row">
                <input type="number" name="phone" class="input_control" value="{{ old('phone') }}"
                  placeholder="Số điện thoại" />
                @if ($errors->has('phone'))
                <script>
                  document.getElementById("phone").classList.add("is-invalid");
                </script>
                <div class="invalid-feedback" style="display: block;">{{ $errors->first('phone') }}</div>
                @endif
              </div>
              <div class="form_row">
                <input type="text" name="email" value="{{ old('email') }}" class="input_control" placeholder="Gmail" />
              </div>
              <div class="form_row">
                <input type="text" name="address" value="{{ old('address') }}" class="input_control"
                  placeholder="Địa chỉ" />
              </div>
              <div class="form_row">
                <textarea class="input_control" placeholder="Nội dung"
                  name="description">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                <script>
                  document.getElementById("description").classList.add("is-invalid");
                </script>
                <div class="invalid-feedback" style="display: block;">{{ $errors->first('description') }}</div>
                @endif
              </div>
            </div>
            <button type="submit" class="btn btn-form">
              Gửi
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container d-none">
  <div class="row">
    <div class="col-lg-12">
      <div class="qw_title wow fadeInLeft" data-wow-duration="1.5s">
        <h2 class="tatu_title">
          Hỏi đáp
        </h2>
      </div>
      <div class="qw_list wow fadeInLeft" data-wow-duration="1.5s">
        <div id="accordion">
          @if(isset($data['nstnd-hoi-dap-question-1']))
          <div class="qw_item">
            <h5 class="qw_item_title" id="heading1" data-toggle="collapse" data-target="#collapse1"
              aria-expanded="false" aria-controls="collapse1">
              {{ $data['nstnd-hoi-dap-question-1'] }}
            </h5>
            <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion">
              <div class="qw_item_txt">
                {{ $data['nstnd-hoi-dap-answer-1'] }}
              </div>
            </div>
          </div>
          @endif
          @if(isset($data['nstnd-hoi-dap-question-2']))
          <div class="qw_item">
            <h5 class="qw_item_title" id="heading2" data-toggle="collapse" data-target="#collapse2"
              aria-expanded="false" aria-controls="collapse2">
              {{ $data['nstnd-hoi-dap-question-2'] }}
            </h5>
            <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion">
              <div class="qw_item_txt">
                {{ $data['nstnd-hoi-dap-answer-2'] }}
              </div>
            </div>
          </div>
          @endif
          @if(isset($data['nstnd-hoi-dap-question-3']))
          <div class="qw_item">
            <h5 class="qw_item_title" id="heading3" data-toggle="collapse" data-target="#collapse3"
              aria-expanded="false" aria-controls="collapse3">
              {{ $data['nstnd-hoi-dap-question-3'] }}
            </h5>
            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion">
              <div class="qw_item_txt">
                {{ $data['nstnd-hoi-dap-answer-3'] }}
              </div>
            </div>
          </div>
          @endif
          @if(isset($data['nstnd-hoi-dap-question-4']))
          <div class="qw_item">
            <h5 class="qw_item_title" id="heading4" data-toggle="collapse" data-target="#collapse4"
              aria-expanded="false" aria-controls="collapse4">
              {{ $data['nstnd-hoi-dap-question-4'] }}
            </h5>
            <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
              <div class="qw_item_txt">
                {{ $data['nstnd-hoi-dap-answer-4'] }}
              </div>
            </div>
          </div>
          @endif
          @if(isset($data['nstnd-hoi-dap-question-5']))
          <div class="qw_item">
            <h5 class="qw_item_title" id="heading5" data-toggle="collapse" data-target="#collapse5"
              aria-expanded="false" aria-controls="collapse5">
              {{ $data['nstnd-hoi-dap-question-5'] }}
            </h5>
            <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
              <div class="qw_item_txt">
                {{ $data['nstnd-hoi-dap-answer-5'] }}
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>

    </div>
  </div>
</div>
</div>
<!--Section: Block Content-->

@endsection

@section('title')

@endsection
@section('script')
<script>
  $(document).ready(function () {

    $("#html-convert_1").html($("#html-convert_1").text());
    $("#html-convert_2").html($("#html-convert_2").text());
    $("#html-convert_3").html($("#html-convert_3").text());
    $("#html-convert_4").html($("#html-convert_4").text());

    function change_image(image) {
      var container = document.getElementById("main-image");
      container.src = image.src;
    }

    // $(document).ready(function() {
    //   $('#contactForm').submit(function() {
    //       var formData = $(this).serialize();
    //       $.ajax({
    //           url: '{{ route('register') }}',
    //           type: 'POST',
    //           data: formData,
    //           success: function(response) {
    //               alert(response.message);
    //               // Xử lý phản hồi thành công ở đây (ví dụ: hiển thị thông báo)
    //           },
    //           error: function(xhr) {
    //               // Xử lý lỗi ở đây (ví dụ: hiển thị thông báo lỗi)
    //           }
    //       });
    //   });
    // });
  });
</script>
@endsection