@extends('modules.fontend.layout.index')
@section('facebook_meta')
<meta property="og:image" content="{{ URL::to('/images/products'). '/'. $item['block_2_image']}}" />
@endsection
@section('content')
<!--Section: Block Content-->
<style>
  #html-convert_4 p {
    background: none
  }
</style>


<div class="vnsound_banner banner_introduct banner_khartist">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner_content">
          <h1 class="banner_title wow fadeInUp animated">
            {{ $item['name'] }}
          </h1>
          <div class="banner_txt wow fadeInUp animated" data-wow-delay="0.3s">
            {{ $item['sub_name'] }}
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
            <img src="{{ URL::to('/images/artists'). '/'. $artist['images']}}" alt="" />
            <img src="images/img-welcom2.png" alt="" style="display: block;margin: 35px auto 0;" />
          </div>
          <div class="welcome_right">
            <div class="welcome_right_content">
              <div class="welcome_right_title">
                {{ $artist['name'] }}
              </div>
              <div class="mttn_left_txt" id="html-convert_4">
                {{ $artist['profile'] }}
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
                  {{ $item['block_1_title'] }}
                </h3>
                <div class="mttn_left_txt" id="html-convert_1">
                  {{ $item['block_1_content'] }}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated animated animated"
                style="visibility: visible; animation-name: flipInY;">
                <img src="{{ URL::to('/images/products'). '/'. $item['block_1_image']}}" />
              </div>
            </div>
          </div>
        </div>
        <div class="mttn_row">
          <div class="row">
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated animated animated"
                style="visibility: visible; animation-name: flipInY;">
                <img src="{{ URL::to('/images/products'). '/'. $item['block_2_image']}}" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_left">
                <h3 class="mttn_left_title">
                  {{ $item['block_2_title'] }}
                </h3>
                <div class="mttn_left_txt" id="html-convert_2">
                  {{ $item['block_2_content'] }}
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
                  {{ $item['block_3_title'] }}
                </h3>
                <div class="mttn_left_txt" id="html-convert_3">
                  {{ $item['block_3_content'] }}
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
                <img src="{{ URL::to('/images/products'). '/'. $item['block_3_image']}}" />
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
              @foreach ($students as $items)
              <div class="swiper-slide">
                <div class="outstanding_item">
                  <div class="outstanding_item_img">
                    <span>
                      <img src="{{ URL::to('/images/students'). '/'. $items['thumbnail']}}"
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
              @foreach ($students as $items)
              <div class="swiper-slide">
                <div class="outstanding_item">
                  <div class="outstanding_item_slide d-block">
                    <div class="outstanding_txt_top">
                      {{ $items['opinion'] }}
                    </div>
                    <div class="outstanding_txt_bot">
                      <span>
                        {{ $items['name'] }}
                      </span>
                      {{ $items->getclass->name }}
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
                  Miễn phí
                </div>
                <div class="opinion_bot_money">
                  {{ $item['free_price'] }}
                </div>
                <div class="opinion_bot_body">
                  <div class="mttn_left_txt">
                    @foreach ($item['free_benefit'] as $profit)
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
                  Basic
                </div>
                <div class="opinion_bot_money">
                  {{ $item['basic_price'] }}
                </div>
                <div class="opinion_bot_body">
                  <div class="mttn_left_txt">
                    @foreach ($item['basic_benefit'] as $profit)
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
                  Premium
                </div>
                <div class="opinion_bot_money">
                  {{ $item['premium_price'] }}
                </div>
                <div class="opinion_bot_body">
                  <div class="mttn_left_txt">
                    @foreach ($item['pre_benefit'] as $profit)
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
              Bạn được nhận ngay chế độ hấp dẫn khi đăng ký lịch học, được nhận ngay 3 buổi học
              miễn phí
            </p>
            <p>
              Hệ thống sinh thái cực kỳ hỗ trợ của chúng tôi sẽ thúc đẩy sự nghiệp dj của bạn phát
              triển
            </p>
            <p>
              Hệ thống sinh thái cực kỳ hỗ trợ của chúng tôi sẽ thúc đẩy sự nghiệp dj của bạn phát
              triển
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
          <form>
            <div class="form_content">
              <div class="form_row">
                <input type="text" class="input_control" placeholder="Họ và tên" />
              </div>
              <div class="form_row">
                <input type="text" class="input_control" placeholder="Số điện thoại" />
              </div>
              <div class="form_row">
                <input type="text" class="input_control" placeholder="Gmail" />
              </div>
              <div class="form_row">
                <input type="text" class="input_control" placeholder="Đại chỉ" />
              </div>
              <div class="form_row">
                <textarea class="input_control" placeholder="Nội dung mong muốn hợp tác"></textarea>
              </div>
            </div>
            <a href="javascript:void(0)" class="btn btn-form">
              Gửi
            </a>
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
$(document).ready(function() {

  $("#html-convert_1").html($("#html-convert_1").text());
  $("#html-convert_2").html($("#html-convert_2").text());
  $("#html-convert_3").html($("#html-convert_3").text());
  $("#html-convert_4").html($("#html-convert_4").text());

  function change_image(image) {

    var container = document.getElementById("main-image");

    container.src = image.src;
  }
  document.addEventListener("DOMContentLoaded", function(event) {

  });
});
</script>
@endsection