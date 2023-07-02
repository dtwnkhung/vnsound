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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<div class="wrapperr">
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
  <div class="vnsound_outstanding" style="min-height:100vh">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="img-detail">
            <div class="banner-intro text-center rounded-lg px-3 mt-3">
              <div class="text-uppercase font-title text-white font-18pt">
                {{ $imageLibrary[0]['title'] }} </div>
            </div>
            {{-- <div class="img-detail-list row row-medium-space"> --}}
            <!-- item -->
            {{-- @foreach ($imageLibrary as $item)
                              
                                    <div class="img-item col-sm-12 col-md-12 col-lg-6 mt-4">
                                        @php
                                            $images = explode(',', $item['images']);
                                        @endphp
                                        @foreach ($images as $img)
                                      
                                        <a data-fancybox="img-detail" href="{{ URL::to('/images/sliders'). '/'. $img}}">
            <img src="{{ URL::to('/images/sliders'). '/'. $img}}" class="img-fluid w-100 rounded-lg" alt="">
            </a>
            @endforeach
          </div>
          @endforeach --}}

          <div class="artists_list landmark_list">
            <div class="swiper-container  outstanding_slide landmark_slide">
              <div class="swiper-wrapper">
                @foreach ($imageLibrary as $item)
                @php
                $images = explode(',', $item['images']);
                @endphp
                @foreach ($images as $img)
                <div class="swiper-slide">
                  <div class="outstanding_item">
                    <a href="javascript:void(0)" class="landmark_item_img">
                      <img src="{{ URL::to('/images/sliders'). '/'. $img}}" />
                    </a>
                  </div>
                </div>
                @endforeach
                @endforeach
              </div>
              <div class="swiper-pagination swiper-pagination-landmark"></div>
              <div class="swiper-button-next swiper-button-next-landmark"></div>
              <div class="swiper-button-prev swiper-button-prev-landmark"></div>
            </div>
          </div>
          {{-- <div class="img-item col-sm-12 col-md-12 col-lg-6 mt-4">
                                    <a data-fancybox="img-detail" href="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG">
                                        <img src="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG" class="img-fluid w-100 rounded-lg"
                                            alt="">
                                    </a>
                                </div> --}}
          {{-- <div class="img-item col-sm-12 col-md-12 col-lg-6 mt-4">
                                    <a data-fancybox="img-detail" href="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG">
                                        <img src="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG" class="img-fluid w-100 rounded-lg"
                                            alt="">
                                    </a>
                                </div>
                                <div class="img-item col-sm-12 col-md-12 col-lg-6 mt-4">
                                    <a data-fancybox="img-detail" href="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG">
                                        <img src="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG" class="img-fluid w-100 rounded-lg"
                                            alt="">
                                    </a>
                                </div>
                                <div class="img-item col-sm-12 col-md-12 col-lg-6 mt-4">
                                    <a data-fancybox="img-detail" href="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG">
                                        <img src="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG" class="img-fluid w-100 rounded-lg"
                                            alt="">
                                    </a>
                                </div>
                                <div class="img-item col-sm-12 col-md-12 col-lg-6 mt-4">
                                    <a data-fancybox="img-detail" href="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG">
                                        <img src="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG" class="img-fluid w-100 rounded-lg"
                                            alt="">
                                    </a>
                                </div>
                                <div class="img-item col-sm-12 col-md-12 col-lg-6 mt-4">
                                    <a data-fancybox="img-detail" href="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG">
                                        <img src="https://vnsound.com.vn/images/sliders/8d12Xo2wGa1iqKo.JPG" class="img-fluid w-100 rounded-lg"
                                            alt="">
                                    </a>
                                </div> --}}
          {{-- </div> --}}
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
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script>
$('.ic-click').click(function() {
  $(this).next().toggle(300);
})
</script>
@endsection