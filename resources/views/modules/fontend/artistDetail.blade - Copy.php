@extends('modules.fontend.layout.index')
@section('content')


<div class="vnsound_banner banner_introduct banner_pfartist"
  style="background: url({{ URL::to('/images/artists'). '/'. $item['banner']}})">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner_content">
          <h1 class="banner_title wow fadeInUp animated">
            {{ $item['name'] }}
          </h1>
          <div class="banner_txt wow fadeInUp animated" data-wow-delay="0.3s">
            Build up your name
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="detaiartist_welcome">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="welcome_content">
          <div class="welcome_left">
            <img src="{{ URL::to('/images/artists'). '/' .$item[" images"] }}" alt="" class="w-100" />
            <img src="images/img-welcom2.png" alt="" style="display: block;margin: 35px auto 0;" />
          </div>
          <div class="welcome_right">
            <div class="welcome_right_content">
              <div class="welcome_right_title">
                <span>
                  Welcome to
                </span>
                Profile {{ $item['name'] }}
              </div>
              <div class="mttn_left_txt">
                {{ $item['profile'] }}
              </div>
              <div class="welcome_right_box">
                <a href="" class="btn welcome_right_btn" data-toggle="modal" data-target="#proj_follow">
                  Liên hệ với tôi
                </a>
                <a href="" class="welcome_right_links color-follow follow-trigger">
                  Follow me*
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="detaiartist_dct">
  <div class="dct_tab">
    <div class="dct_tab_item active" data-id="1">
      Club đã cộng tác
    </div>
    <div class="dct_tab_item" data-id="2">
      Đứng cùng nghệ sỹ lớn nhỏ
    </div>
  </div>
  <div class="dct_content">
    <div class="dct_other" id="dct1" style="display: block;">
      <div class="dct_child">
        @foreach ($item['clubs'] as $img)
        <div class="dct_other_item">
          <img src="{{ URL::to('/images/artists'). '/'. $img}}" />
        </div>
        @endforeach
      </div>
    </div>
    <div class="dct_other" id="dct2">
      <div class="dct_child">
        @foreach ($item['partners'] as $img)
        <div class="dct_other_item">
          <img src="{{ URL::to('/images/artists'). '/'. $img}}" />
        </div>
        @endforeach
      </div>
    </div>
    <div class="dct_box_ps">
      <div class="dct_box_ps_title">
        Club<br />
        Đã Cộng tác#vns.
      </div>
      <div class="welcome_right_box">
        <a href="" class="btn btn_khartist" data-toggle="modal" data-target="#proj_follow">
          Liên hệ ngay <img src="images/ic-15.png" alt="" />
        </a>
        <span>
          <img src="images/img-dct-pos.png" alt="" />
        </span>
      </div>
    </div>
  </div>

</div>
<div class="detaiartist_boxdtns">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="boxdtns_left">
          <div class="boxdtns_left_item" id="popup_mennu_item_1" data-id="1">
            <h4>
              Project 1
            </h4>
            {{ $item['project_1_title'] }}
          </div>
          <div class="boxdtns_left_item" id="popup_mennu_item_2" data-id="2">
            <h4>
              Project 2
            </h4>
            {{ $item['project_2_title'] }}
          </div>
          <img src="images/img-dtn.png" alt="" />
        </div>
      </div>
      <div class="col-md-6 slider-container">
        <div class="d-flex">
          <div class="vertical-nav d-flex flex-column" style="flex-shrink: 0;">
            <a class="text-uppercase d-flex align-items-center justify-content-center vertical-nav-item active"
              data-nav-id="1">we are my team</a>
            <a class="text-uppercase d-flex align-items-center justify-content-center vertical-nav-item"
              data-nav-id="2">we are my team</a>
          </div>
          <div class="prj-content-container w-100">
            <div class="prj-content ml-auto active" data-prj-id="1">
              <div class="boxdtns_right h-100">
                <!-- <div class="boxdtns_right_img">
                                    <img src="images/bg-left.png" alt="" />
                                </div> -->
                <div class="artists_list boxdtns_right_list">
                  <div class="swiper-container boxdtns_right_slide">
                    <div class="swiper-wrapper">
                      @foreach ($item->project_1_image as $key => $img)
                      @if (!empty($img))
                      <div class="swiper-slide">
                        <div class="boxdtns_right_slide_img">
                          <img src="{{ URL::to('/images/artists'). '/'. $img}}" />
                        </div>
                      </div>
                      @endif
                      @endforeach
                      {{-- <div class="swiper-slide">
                        <div class="boxdtns_right_slide_img">
                          <img src="{{ URL::to('/images/artists'). '/'. $item['project_1_image']}}" />
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="boxdtns_right_slide_img">
                          <img src="{{ URL::to('/images/artists'). '/'. $item['project_2_image']}}" />
                        </div>
                      </div> --}}
                    </div>
                    <div class="swiper-pagination swiper-pagination-boxdtns"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="prj-content ml-auto" data-prj-id="2">
              <div class="boxdtns_right h-100">
                <!-- <div class="boxdtns_right_img">
                                    <img src="images/bg-left.png" alt="" />
                                </div> -->
                <div class="artists_list boxdtns_right_list">
                  <div class="swiper-container boxdtns_right_slide_2">
                    <div class="swiper-wrapper">
                      @foreach ($item->project_2_image as $key => $img)
                      @if (!empty($img))
                      <div class="swiper-slide">
                        <div class="boxdtns_right_slide_img">
                          <img src="{{ URL::to('/images/artists'). '/'. $img}}" />
                        </div>
                      </div>
                      @endif
                      @endforeach
                      {{-- <div class="swiper-slide">
                        <div class="boxdtns_right_slide_img">
                          <img src="{{ URL::to('/images/artists'). '/'. $item['project_1_image']}}" />
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="boxdtns_right_slide_img">
                          <img src="{{ URL::to('/images/artists'). '/'. $item['project_2_image']}}" />
                        </div>
                      </div> --}}
                    </div>
                    <div class="swiper-pagination swiper-pagination-boxdtns"></div>
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
<div class="detaiartist_scenes" id="follow-artist">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="scenes_left">
          <a href="{{ $item['bts_link_yt'] }}" target="_blank" class="d-block">
            <img src="{{ URL::to('/images/artists'). '/'. $item['bts_image']}}" />
          </a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="scenes_right">
          <h5>
            <img src="images/ic-18.png" alt="" style="display: block;" />
            FOLLOW ME
          </h5>
          <div class="scenes_right_txt">
            {{ $item['bts_text'] }}
          </div>
          <div class="scenes_right_ic">
            <a href="{{ $item['bts_link_sc'] }}">
              <img src="images/ic-16.png" alt="" />
            </a>
            <a href="{{ $item['bts_link_yt'] }}">
              <img src="images/ic-17.png" alt="" />
            </a>
            <a href="#">
              <img src="images/ic-tiktok.png" alt="" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="vnsound_lifestyle">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <div class="vnsound_title_bg d-none wow slideInUp animated animated"
            style="visibility: visible; animation-name: slideInUp;">
            life style
          </div>
          <h2 class="vnsound_title wow fadeInUp animated animated" data-wow-delay="0.2s"
            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
            life style
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="events_list">
    <div class="row">
      <div class="col-md-6">
        <div class="events_img_child">
          <div class="row">
            <div class="col-md-12">
              <div class="events_img_box">
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    @if($item['life_style_1'])
                    <a href="javascript:void(0)" class="events_img_item">
                      <img src="{{ URL::to('/images/artists'). '/'. $item['life_style_1']}}" />
                    </a>
                    @endif
                  </div>
                  <div class="col-md-6 col-sm-6">
                    @if($item['life_style_2'])
                    <a href="javascript:void(0)" class="events_img_item">
                      <img src="{{ URL::to('/images/artists'). '/'. $item['life_style_2']}}" />
                    </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              @if($item['life_style_3'])
              <a href="javascript:void(0)" class="events_img_item events_img_item2">
                <img src="{{ URL::to('/images/artists'). '/'. $item['life_style_3']}}" />
              </a>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="events_img_child">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              @if($item['life_style_4'])
              <a href="javascript:void(0)" class="events_img_item events_img_item3">
                <img src="{{ URL::to('/images/artists'). '/'. $item['life_style_4']}}" />
              </a>
              @endif
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="events_img_box_last">
                @if($item['life_style_5'])
                <a href="javascript:void(0)" class="events_img_item">
                  <img src="{{ URL::to('/images/artists'). '/'. $item['life_style_5']}}" />
                </a>
                @endif
                @if($item['life_style_6'])
                <a href="javascript:void(0)" class="events_img_item">
                  <img src="{{ URL::to('/images/artists'). '/'. $item['life_style_6']}}" />
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@if (session('thongbao'))
<script>
  var message = "{{ session('thongbao') }}";
  alert(message)
</script>
@endif
@endsection

@section('title')

@endsection
@section('script')
<script>
  $(document).ready(function () {
    $('#select-files').click(function () {
      console.log('test')
      $('#certificate').click()
      return false
    })
    $('#submitForm').click(function () {
      $('#main-form').submit()
    })

    $("#dct1 .dct_other_item").last().hide();
  })
</script>

@endsection