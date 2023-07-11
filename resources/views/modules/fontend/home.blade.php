@extends('modules.fontend.layout.index')
@section('content')
<div class="vnsound_banner">
  <div class="container position-relative" style="z-index:9">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner_content">
          <h1 class="banner_title wow fadeInUp animated">
            {{ $data['home-banner-title'] }}
          </h1>
          <div class="banner_txt wow fadeInUp animated" data-wow-delay="0.3s">
            {{ $data['home-banner-text'] }}
          </div>
          <div class="banner_content_box">
            <a href="/gioi-thieu.html" class="btn btn-main wow fadeInUp animated" data-wow-delay="0.6s">
              Tìm hiểu thêm
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="vnsound_date">
  <div class="container position-relative" style="z-index:9">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="date_title wow fadeInUp animated" data-wow-delay="0s">
          {{ $data['home-date-title'] }}
        </h2>
        <div class="date_txt wow fadeInUp animated" data-wow-delay="0.2s">
          {{ $data['home-date-text'] }}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="vnsound_artists position-relative">

  <div class="deco-1 deco-img position-absolute">
    <img src="../../../../public/images/deco-1.png" class="img-fluid" />
  </div>
  <!-- <div class="deco-2 deco-img position-absolute">
        <img src="../../../../public/images/deco-2.png" class="img-fluid" />
    </div> -->
  <div class="container position-relative" style="z-index:9">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <!-- <div class="vnsound_title_bg d-none wow slideInUp animated">
                        artists
                    </div> -->
          <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
            Nghệ sĩ
          </h2>
        </div>
        <div class="artists_list">
          <div class="swiper-container artists_slide">
            <div class="swiper-wrapper">
              @foreach ($artists as $artist)
              <div class="swiper-slide">
                <a href="{{ route('home.artistDetail', ['slug' => $artist['slug']]) }}"
                  class="artists_item wow flipInY animated">
                  <img src="{{ URL::to('/images/artists'). '/'. $artist['images']}}" class="mw-100" />
                  <span class="artists_item_name">
                    {{ $artist['name'] }}
                  </span>
                </a>
              </div>
              @endforeach
            </div>
            <div class="swiper-pagination swiper-pagination-artists"></div>
            <!-- <div class="swiper-button-next swiper-button-next-artists"></div>
                            <div class="swiper-button-prev swiper-button-prev-artists"></div> -->
          </div>
        </div>
        <div class="artists_bot">
          {{ $data['home-artist-text'] }}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="vnsound_course position-relative">
  <div class="deco-2 deco-img position-absolute">
    <img src="../../../../public/images/deco-2.png" class="img-fluid" />
  </div>
  <div class="deco-3 deco-img position-absolute">
    <img src="../../../../public/images/deco-3.png" class="img-fluid" />
  </div>
  <div class="container position-relative" style="z-index:9">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <!-- <div class="vnsound_title_bg d-none wow slideInUp animated">
                        course
                    </div> -->
          <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
            khóa học
          </h2>
        </div>
        <div class="course_tab">
          <div class="course_tab_other">
            @foreach ($products as $key => $pro)
            @if($key == 0)
            <div class="course_tab_item active" data-id="{{ $pro['id']}}">
              @else
              <div class="course_tab_item" data-id="{{ $pro['id']}}">
                @endif
                <div class="course_tab_item_txt">
                  {{ $pro['name']}}
                </div>
                Khai Giảng <span>{{ date('Y-m-d', strtotime($pro['start_time'])) }}</span>
              </div>
              @endforeach
            </div>
          </div>
          <div class="course_content">
            @foreach ($products as $key => $pro)
            @if($key == 0)
            <div class="course_content_other" id="course_box{{ $pro['id']}}" style="display: block;">
              @else
              <div class="course_content_other" id="course_box{{ $pro['id']}}" style="display: none;">
                @endif
                <div class="row">
                  <div class="col-md-6">
                    <div class="course_content_left">
                      <h3>
                        {{ $pro['name']}}
                      </h3>
                      <div class="course_content_txt" id="html-convert">
                        {{ $pro['description'] }}
                      </div>
                      <a href="{{ route('home.products', ['id' => $pro['id']]) }}" class="btn btn-main">
                        Tìm hiểu thêm
                      </a>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="course_content_right">
                      <img src="{{ URL::to('/images/products'). '/'. $pro['images']}}" />
                    </div>
                  </div>
                </div>>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="vnsound_gallery position-relative">
  <div class="deco-4 deco-img position-absolute">
    <img src="../../../../public/images/deco-4.png" class="img-fluid" />
  </div>

  {{-- <div class="container position-relative" style="z-index:9">
        <div class="row">
            <div class="col-lg-12">
                <div class="vnsound_box_all">
                    <!-- <div class="vnsound_title_bg d-none wow slideInUp animated">
                        gallery
                    </div> -->
                    <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
                        thư viện
                    </h2>
                </div>
                <div class="gallery_list">
                    <div style="" class="swiper-container detail_child_slide">
                        <div class="swiper-wrapper">
                            @foreach ($sliders as $slide)
                            <div class="swiper-slide">
                                <div class="detail_child_slide_img">
                                    <img src="{{ URL::to('/images/sliders'). '/'. $slide['images']}}" />
</div>
</div>
@endforeach
</div>
<div class="swiper-button-next swiper-button-next-other-slide"></div>
<div class="swiper-button-prev swiper-button-prev-other-slide"></div>
</div>
<div thumbsSlider="" class="swiper-container detail_other_slide">
  <div class="swiper-wrapper">

    @foreach ($sliders as $slide)
    <div class="swiper-slide">
      <div class="detail_other_slide_img">
        <img src="{{ URL::to('/images/sliders'). '/'. $slide['images']}}" />
      </div>
    </div>
    @endforeach
  </div>
</div>
</div>
</div>
</div>
</div> --}}
</div>
<div class="vnsound_sponcor position-relative">
  <div class="deco-5 deco-img position-absolute">
    <img src="../../../../public/images/deco-5.png" class="img-fluid" />
  </div>
  <div class="container position-relative" style="z-index:9">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <!-- <div class="vnsound_title_bg d-none wow slideInUp animated">
                        sponcor
                    </div> -->
          <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
            đối tác
          </h2>
        </div>
        <div class="sponcor_list">
          <div class="swiper-container sponcor_slide">
            <div class="swiper-wrapper">
              @foreach ($partners as $item)
              <div class="swiper-slide">
                <div class="sponcor_slide_item">
                  <img src="{{ URL::to('/images/partners'). '/'. $item['images']}}" class="rounded-circle" width="150px"
                    height="150px" style="object-fit:cover" />
                </div>
              </div>
              @endforeach
            </div>
            <div class="swiper-pagination swiper-pagination-sponcor"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="vnsound_knowledge position-relative">
  <div class="deco-6 deco-img position-absolute">
    <img src="../../../../public/images/deco-6.png" class="img-fluid" />
  </div>
  <div class="deco-8 deco-img position-absolute">
    <img src="../../../../public/images/img-ttth5.png" class="img-fluid" />
  </div>
  <div class="container position-relative" style="z-index:9">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <!-- <div class="vnsound_title_bg d-none wow slideInUp animated">
                        news/knowledge
                    </div> -->
          <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
            tin tức/kiến thức
          </h2>
        </div>
        <div class="knowledge_tab">
          <div class="knowledge_tab_other">
            <div class="knowledge_tab_item active" data-id="1">
              <div class="course_tab_item_txt">
                Tin tức
              </div>
            </div>
            <div class="knowledge_tab_item" data-id="2">
              <div class="course_tab_item_txt">
                Kiến thức
              </div>
            </div>
          </div>
        </div>
        <div class="course_content">
          <div class="knowledge_content_other" id="knowledge_box1" style="display: block;">
            <div class="swiper-container knowledge_content_slide">
              <div class="swiper-wrapper">
                @foreach ($news as $item)
                <div class="swiper-slide">
                  <div class="knowledge_item">
                    <div class="knowledge_item_img wow flipInY animated animated">
                      <img src="{{ URL::to('/images/news'). '/'. $item['images']}}" />
                    </div>
                    <div class="knowledge_item_body">
                      <div class="knowledge_item_date">
                        {{ $item->ngay_sua }}
                      </div>
                      <a href="{{ route("home.news", ["slug" => $item['slug']]) }}" class="knowledge_item_title">
                        {{ $item->title }}
                      </a>
                      <a class="knowledge_item_links" href="{{ route("home.news", ["slug" => $item['slug']]) }}">
                        Xem thêm
                      </a>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="swiper-pagination swiper-pagination-knowledge"></div>
            </div>
          </div>
          <div class="knowledge_content_other" id="knowledge_box2">
            <div class="swiper-container knowledge_content_slide">
              <div class="swiper-wrapper">
                @foreach ($kienthuc as $item)
                <div class="swiper-slide">
                  <div class="knowledge_item">
                    <div class="knowledge_item_img wow flipInY animated animated">
                      <img src="{{ URL::to('/images/news'). '/'. $item['images']}}" />
                    </div>
                    <div class="knowledge_item_body">
                      <div class="knowledge_item_date">
                        {{ $item->ngay_sua }}
                      </div>
                      <a href="{{ route("home.news", ["slug" => $item['slug']]) }}" class="knowledge_item_title">
                        {{ $item->title }}
                      </a>
                      <a class="knowledge_item_links" href="{{ route("home.news", ["slug" => $item['slug']]) }}">
                        Xem thêm
                      </a>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="swiper-pagination swiper-pagination-knowledge"></div>
            </div>
          </div>
        </div>
        <div class="knowledge_box">
          <a href="{{ route('home.listnews') }}" class="btn btn-main">
            Xem tất cả
          </a>
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
$(document).ready(function() {
  $("#html-convert").html($("#html-convert").text());
  $('#select-files').click(function() {
    console.log('test')
    $('#certificate').click()
    return false
  })
  $('#certificate').change(function() {
    var html = ''
    if (this.files.length > 0) {
      console.log(this.files);
      for (let i = 0; i < this.files.length; i++) {
        html +=
          '<li class="list-group-item list-group-item-action list-group-item-success">' +
          this.files[i].name + '(' + this.files[i].size + 'B)</li>'
      }
      $('#list-images').html(html)
    }
  })
  $('#submitForm').click(function() {
    $('#main-form').submit()
  })
})
</script>

@endsection