@extends('modules.fontend.layout.index_not_header')
@section('css')
<style>
.libary_sidebar_child {
  padding-left: 15px;
  display: none;
}

.ic-click {
  display: block;
  width: 24px;
  height: 24px;
  background: transparent url('../images/ic-1.png') no-repeat center center;
  position: absolute;
  z-index: 2;
  top: 0;
  right: 0;
  cursor: pointer;
}

.libary_menu_sidebar_list li .libary_sidebar_child a {
  display: block;
  font-family: 'Inter';
  font-style: normal;
  font-weight: 500;
  font-size: 14px;
  line-height: 150%;
  text-transform: uppercase;
  color: #999999;
  padding: 5px 0;
}

.libary_menu_sidebar_list li .libary_sidebar_child a:hover {
  color: #fff;
}
</style>
@endsection
@section('content')
<div class="wrapper">
  <!-- <div id="preloader">
    <div class="preloader1"></div>
  </div> -->
  <!-- header begin -->
  <div class="libary_area">
    <div class="libary_area_menu_inner">
      <a href="javascript:void(0)" class="libary_area_op">
        <img src="images/ic-2.png" alt="" />
      </a>
      <a href="" class="libary_area_logo">
        <img src="images/logo-main.png" style="height:50px" />
      </a>
      <div class="libary_area_menu_sidebar">
        <div class="libary_menu_sidebar_top">
          <a href="javascript:void(0)" class="libary_area_close">
            <img src="images/ic-14.png" alt="" />
          </a>
          <a href="" class="libary_area_logo">
            <img src="images/logo-main.png" style="height:30px" />
          </a>
        </div>
        <ul class="libary_menu_sidebar_list">
          <li>
            <a href="/">
              Trang chủ
            </a>
          </li>
          <li>
            <a href="/gioi-thieu.html">
              Giới thiệu
            </a>
          </li>
          <li>
            <a href="/nghe-si.html">
              Profile
            </a>
          </li>
          <li>
            <a href="thu-vien.html" class="active">
              Thư viện
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">Khóa học</a>
            <div class="ic-click"></div>
            <div class="libary_sidebar_child">
              @foreach ($dataShare['products'] as $item)
              <a href="{{ route('home.products', ['id' => $item['id']]) }}">{{ $item['name'] }}</a>
              @endforeach
            </div>
          </li>
          <li>
            <a href="{{ route('home.listnews') }}">
              tin tức
            </a>
          </li>
          <li>
            <a href="{{ route('home.knowledges') }}">
              kiến thức
            </a>
          </li>
          <li>
            <a href="{{ route('home.contact') }}">
              liên hệ
            </a>
          </li>
        </ul>
        <div class="footer_bot_last">
          <a href="">
            <img src="images/ic-7.png" alt="">
          </a>
          <a href="">
            <img src="images/ic-8.png" alt="">
          </a>
          <a href="">
            <img src="images/ic-9.png" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="vnsound_libary">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          {{-- <ul class="libary_main_menu">
                            <li>
                                <a href="">
                                    mc
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    dj
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Producer
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    mkt
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Khác
                                </a>
                            </li>
                        </ul> --}}
          {{-- <div class="libary_main_slide">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="libary_main_menu_title">
                                    mc
                                </div>
                                <div class="libary_main_other">
                                    <div class="swiper-container libary_slide">
                                        <div class="swiper-wrapper">
                                            @foreach ($mc as $item)
                                                <div class="swiper-slide">
                                                    <a href="" class="libary_slide_item">
                                                        <img src="{{ URL::to('/images/sliders'). '/'. $item['images']}}"/>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="libary_main_menu_title">
    dj
  </div>
  <div class="libary_main_other">
    <div class="swiper-container libary_slide">
      <div class="swiper-wrapper">
        @foreach ($dj as $item)
        <div class="swiper-slide">
          <a href="" class="libary_slide_item">
            <img src="{{ URL::to('/images/sliders'). '/'. $item['images']}}" />
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="libary_main_menu_title">
    Producer
  </div>
  <div class="libary_main_other">
    <div class="swiper-container libary_slide">
      <div class="swiper-wrapper">
        @foreach ($producer as $item)
        <div class="swiper-slide">
          <a href="" class="libary_slide_item">
            <img src="{{ URL::to('/images/sliders'). '/'. $item['images']}}" />
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="libary_main_menu_title">
    mkt
  </div>
  <div class="libary_main_other">
    <div class="swiper-container libary_slide">
      <div class="swiper-wrapper">
        @foreach ($mkt as $item)
        <div class="swiper-slide">
          <a href="" class="libary_slide_item">
            <img src="{{ URL::to('/images/sliders'). '/'. $item['images']}}" />
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="libary_main_menu_title">
    Khác
  </div>
  <div class="libary_main_other">
    <div class="swiper-container libary_slide">
      <div class="swiper-wrapper">
        @foreach ($other as $item)
        <div class="swiper-slide">
          <a href="" class="libary_slide_item">
            <img src="{{ URL::to('/images/sliders'). '/'. $item['images']}}" />
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
</div>
</div> --}}
<div class="img-gallery">
  <div class="banner-intro text-center rounded-lg px-3 my-3">
    <div class="text-uppercase font-title text-white font-22pt">Thư viện hình ảnh</div>
  </div>
  <div class="img-list row row-medium-space">
    <!-- ITEM -->
    @foreach ($sliders as $item)
    <div class="img-item col-sm-12 col-md-12 col-lg-3 mb-4">
      <a href="{{ route('home.viewDetailLibrary', $item['id']) }}" class="d-block overflow-hidden radius-sm shadow">
        <img
          src="{{ URL::to('/images/slider_key'). '/'. (isset($item['images_key']) ? $item['images_key'] : "noimage.jpg")}}"
          style="aspect-ratio:1;width:100%;" alt="">
        <div class="content-img p-3">
          <h5 class="font-15pt mb-0 font-title text-trim-line text-one-line text-white text-center">
            {{ $item['title'] }}
          </h5>
        </div>
      </a>
    </div>
    @endforeach


    {{-- <div class="img-item col-sm-12 col-md-12 col-lg-3 mb-4">
                                    <a href="{{ route('home.viewDetailLibrary', '7') }}"
    class="d-block overflow-hidden radius-sm shadow">
    <img
      src="{{ URL::to('/images/sliders'). '/'. (isset($studio[0]['images']) ? $studio[0]['images'] : "noimage.jpg")}}"
      style="aspect-ratio:1;width:100%;" alt="">
    <div class="content-img p-3">
      <h5 class="font-15pt mb-0 font-title text-trim-line text-one-line text-white text-center">
        STUDIO </h5>
    </div>
    </a>
  </div>

  <div class="img-item col-sm-12 col-md-12 col-lg-3 mb-4">
    <a href="{{ route('home.viewDetailLibrary', '2') }}" class="d-block overflow-hidden radius-sm shadow">
      <img src="{{ URL::to('/images/sliders'). '/'. (isset($dj[0]['images']) ? $dj[0]['images'] : "noimage.jpg")}}"
        style="aspect-ratio:1;width:100%;" alt="">
      <div class="content-img p-3">
        <h5 class="font-15pt mb-0 font-title text-trim-line text-one-line text-white text-center">
          DJ </h5>
      </div>
    </a>
  </div>

  <div class="img-item col-sm-12 col-md-12 col-lg-3 mb-4">
    <a href="{{ route('home.viewDetailLibrary', '5') }}" class="d-block overflow-hidden radius-sm shadow">
      <img
        src="{{ URL::to('/images/sliders'). '/'. (isset($event[0]['images']) ? $event[0]['images'] : "noimage.jpg")}}"
        style="aspect-ratio:1;width:100%;" alt="">
      <div class="content-img p-3">
        <h5 class="font-15pt mb-0 font-title text-trim-line text-one-line text-white text-center">
          SỰ KIỆN
        </h5>
      </div>
    </a>
  </div>

  <div class="img-item col-sm-12 col-md-12 col-lg-3 mb-4">
    <a href="{{ route('home.viewDetailLibrary', '4') }}" class="d-block overflow-hidden radius-sm shadow">
      <img src="{{ URL::to('/images/sliders'). '/'. (isset($mkt[0]['images']) ? $mkt[0]['images'] : "noimage.jpg")}}"
        style="aspect-ratio:1;width:100%;" alt="">
      <div class="content-img p-3">
        <h5 class="font-15pt mb-0 font-title text-trim-line text-one-line text-white text-center">
          MKT
        </h5>
      </div>
    </a>
  </div>

  <div class="img-item col-sm-12 col-md-12 col-lg-3 mb-4">
    <a href="{{ route('home.viewDetailLibrary', '9') }}" class="d-block overflow-hidden radius-sm shadow">
      <img
        src="{{ URL::to('/images/sliders'). '/'. (isset($profile[0]['images']) ? $profile[0]['images'] : "noimage.jpg")}}"
        style="aspect-ratio:1;width:100%;" alt="">
      <div class="content-img p-3">
        <h5 class="font-15pt mb-0 font-title text-trim-line text-one-line text-white text-center">
          PROFILE </h5>
      </div>
    </a>
  </div>

  <div class="img-item col-sm-12 col-md-12 col-lg-3 mb-4">
    <a href="{{ route('home.viewDetailLibrary', '8') }}" class="d-block overflow-hidden radius-sm shadow">
      <img
        src="{{ URL::to('/images/sliders'). '/'. (isset($workshop[0]['images']) ? $workshop[0]['images'] : "noimage.jpg")}}"
        style="aspect-ratio:1;width:100%;" alt="">
      <div class="content-img p-3">
        <h5 class="font-15pt mb-0 font-title text-trim-line text-one-line text-white text-center">
          WORKSHOP </h5>
      </div>
    </a>
  </div>

  <div class="img-item col-sm-12 col-md-12 col-lg-3 mb-4">
    <a href="{{ route('home.viewDetailLibrary', '3') }}" class="d-block overflow-hidden radius-sm shadow">
      <img
        src="{{ URL::to('/images/sliders'). '/'. (isset($producer[0]['images']) ? $producer[0]['images'] : "noimage.jpg")}}"
        style="aspect-ratio:1;width:100%;" alt="">
      <div class="content-img p-3">
        <h5 class="font-15pt mb-0 font-title text-trim-line text-one-line text-white text-center">
          PRODUCER </h5>
      </div>
    </a>
  </div> --}}
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection

@section('title')
@endsection
@section('script')
<script>
$('.ic-click').click(function() {
  $(this).next().toggle(300);
})
</script>
@endsection