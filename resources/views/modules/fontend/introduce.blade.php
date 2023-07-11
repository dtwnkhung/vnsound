@extends('modules.fontend.layout.index')
@section('css')
@endsection
@section('content')
<div class="vnsound_banner banner_introduct">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner_content">
          <h1 class="banner_title wow fadeInUp animated">
            Về chúng tôi
          </h1>
          <div class="banner_txt wow fadeInUp animated" data-wow-delay="0.3s">
            Rock off and rave on
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="introduct_ceo d-none">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="ceo_content">
          <div class="ceo_list">
            <div class="row">
              @foreach ($artists as $item)
              <div class="col-md-3 col-sm-3">
                <div class="ceo_item">
                  <div class="ceo_item_img">
                    <img src="{{ URL::to('/images/artists'). '/'. $item['images']}}" />
                  </div>
                  <div class="ceo_item_title">
                    {{ $item['name'] }}
                  </div>
                  <div class="ceo_item_txt">
                    {{ Helper::subTitle($item['profile'], 150) }}
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="introduct_mttn">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="mttn_row mttn_row2">
          <div class="row">
            <div class="col-md-6">
              <div class="mttn_left">
                <h3 class="mttn_left_title">
                  {{ $data['gioi-thieu-block-1-title'] }}
                </h3>
                <div class="mttn_left_txt">
                  {{ $data['gioi-thieu-block-1-text'] }}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated">
                <img src="{{ URL::to('/images/components'). '/'. $data['gioi-thieu-block-1-image']}}" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="introduct_mttn introduct_mttn2">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="mttn_row">
          <div class="row">
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated">
                <img src="{{ URL::to('/images/components'). '/'. $data['gioi-thieu-block-2-image']}}" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_left">
                <h3 class="mttn_left_title">
                  {{ $data['gioi-thieu-block-2-title'] }}
                </h3>
                <div class="mttn_left_txt">
                  <!-- {{ $data['gioi-thieu-block-2-text'] }} -->
                  - Năm thành lập: 2017<br />
                  - Số lượng học viên đã đào tạo: 93<br />
                  - 30 sản phẩm phát hành bởi VNSound Music<br />
                  - 32,000+ người hâm mộ trên fanpage VNSound<br />
                  - Gần 500,000 lượt người đọc trên cổng thông tin về âm nhạc điện tử vietnamsound.com Bamboo City
                  Carnival - chuỗi sự kiện do VNSound đồng tổ chức thu hút hơn 2500 người tham dự
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="introduct_video">
  <video id="id_video" width="100%" height="100%" autoplay controls loop>
    <source src="{{ URL::to('/images/components'). '/files/'. $data['gioi-thieu-video']->files}}" type="video/mp4">
    Sorry, your browser doesn't support embedded videos.
  </video>
</div>
<div class="vnsound_sponcor">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <div class="vnsound_title_bg d-none wow slideInUp animated">
            sponcor
          </div>
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
                  <img src="{{ URL::to('/images/partners'). '/'. $item['images']}}" width="150px" height="150px" />
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

<div class="vnsound_service">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <div class="vnsound_title_bg d-none wow slideInUp animated">
            service
          </div>
          <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
            dịch vụ của vnsound
          </h2>
        </div>
        <div class="artists_list">
          <div class="swiper-container service_slide">
            <div class="swiper-wrapper">
              @foreach ($services as $item)
              <div class="swiper-slide">
                <div class="service_item">
                  <a href="javascript:void(0)" class="service_item_img wow flipInY animated">
                    <img src="{{ URL::to('/images/services'). '/'. $item['thumbnail']}}" />
                  </a>
                  <div class="service_item_body">
                    <a href="javascript:void(0)" class="service_item_title">
                      {{ $item['name'] }}
                    </a>
                    <div class="service_item_txt">
                      {!! $item['description'] !!}
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <div class="swiper-pagination swiper-pagination-service"></div>
          </div>
          <div class="swiper-button-next swiper-button-next-service"></div>
          <div class="swiper-button-prev swiper-button-prev-service"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="introduct_mttn introduct_mttn2" style="background-color:#030303!important;background-image:none">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <div class="vnsound_title_bg d-none wow slideInUp animated">
            sponcor
          </div>
          <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
            Dự án của chúng tôi đã thực hiện
          </h2>
        </div>
        @if(isset($projects[0]))
        <div class="mttn_row mttn_row2">
          <div class="row">
            <div class="col-md-6">
              <div class="mttn_left">
                <h3 class="mttn_left_title">
                  {{ $projects[0]['name'] }}
                </h3>
                <div class="mttn_left_txt">
                  {!! $projects[0]['description'] !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated animated"
                style="visibility: visible; animation-name: flipInY;">
                <img src="{{ URL::to('/images/projects'). '/'. $projects[0]['thumbnail']}}" />
              </div>
            </div>
          </div>
        </div>
        @endif
        @if(isset($projects[1]))
        <div class="mttn_row">
          <div class="row">
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated animated"
                style="visibility: visible; animation-name: flipInY;">
                <img src="{{ URL::to('/images/projects'). '/'. $projects[1]['thumbnail']}}" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_left">
                <h3 class="mttn_left_title">
                  {{ $projects[1]['name'] }}
                </h3>
                <div class="mttn_left_txt">
                  {!! $projects[1]['description'] !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif

        @if(isset($projects[2]))
        <div class="mttn_row mttn_row2">
          <div class="row">
            <div class="col-md-6">
              <div class="mttn_left">
                <h3 class="mttn_left_title">
                  {{ $projects[2]['name'] }}
                </h3>
                <div class="mttn_left_txt">
                  {!! $projects[2]['description'] !!}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated animated"
                style="visibility: visible; animation-name: flipInY;">
                <img src="{{ URL::to('/images/projects'). '/'. $projects[2]['thumbnail']}}" />
              </div>
            </div>
          </div>
        </div>
        @endif

        @if(isset($projects[3]))
        <div class="mttn_row">
          <div class="row">
            <div class="col-md-6">
              <div class="mttn_right wow flipInY animated animated animated"
                style="visibility: visible; animation-name: flipInY;">
                <img src="{{ URL::to('/images/projects'). '/'. $projects[3]['thumbnail']}}" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mttn_left">
                <h3 class="mttn_left_title">
                  {{ $projects[3]['name'] }}
                </h3>
                <div class="mttn_left_txt">
                  {!! $projects[3]['description'] !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>

    </div>
  </div>
</div>

<div class="vnsound_events">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <div class="vnsound_title_bg d-none wow slideInUp animated">
            events organized by us
          </div>
          <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
            sự kiện được tổ chức bởi chúng tôi
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
                    @if(isset($events[1]))
                    <a href="javascript:void(0)" class="events_img_item view_detail" data-toggle="modal"
                      data-target="#proj_da" data-id={{ $events[1]['id']}}>
                      <img src="{{ URL::to('/images/events'). '/'. $events[1]['thumbnail']}}" />
                      <span class="events_img_title">
                        <span>
                          {{ $events[1]['name'] }}
                        </span>
                      </span>
                    </a>
                    @endif
                  </div>
                  <div class="col-md-6 col-sm-6">
                    @if(isset($events[2]))
                    <a href="javascript:void(0)" class="events_img_item view_detail" data-toggle="modal"
                      data-target="#proj_da" data-id={{ $events[2]['id']}}>
                      <img src="{{ URL::to('/images/events'). '/'. $events[2]['thumbnail']}}" />
                      <span class="events_img_title">
                        <span>
                          {{ $events[2]['name'] }}
                        </span>
                      </span>
                    </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              @if(isset($events[3]))
              <a href="javascript:void(0)" class="events_img_item events_img_item2 view_detail" data-toggle="modal"
                data-target="#proj_da" data-id={{ $events[3]['id']}}>
                <img src="{{ URL::to('/images/events'). '/'. $events[3]['thumbnail']}}" />
                <span class="events_img_title">
                  <span>
                    {{ $events[3]['name'] }}
                  </span>
                </span>
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
              @if(isset($events[4]))
              <a href="javascript:void(0)" class="events_img_item events_img_item3 view_detail" data-toggle="modal"
                data-target="#proj_da" data-id={{ $events[4]['id']}}>
                <img src="{{ URL::to('/images/events'). '/'. $events[4]['thumbnail']}}" />
                <span class="events_img_title">
                  <span>
                    {{ $events[4]['name'] }}
                  </span>
                </span>
              </a>
              @endif
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="events_img_box_last">
                @if(isset($events[5]))
                <a href="javascript:void(0)" class="events_img_item view_detail" data-toggle="modal"
                  data-target="#proj_da" data-id={{ $events[5]['id']}}>
                  <img src="{{ URL::to('/images/events'). '/'. $events[5]['thumbnail']}}" />
                  <span class="events_img_title">
                    <span>
                      {{ $events[5]['name'] }}
                    </span>
                  </span>
                </a>
                @endif
                @if(isset($events[6]))
                <a href="javascript:void(0)" class="events_img_item view_detail" data-toggle="modal"
                  data-target="#proj_da" data-id={{ $events[6]['id']}}>
                  <img src="{{ URL::to('/images/events'). '/'. $events[6]['thumbnail']}}" />
                  <span class="events_img_title">
                    <span>
                      {{ $events[6]['name'] }}
                    </span>
                  </span>
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
<div class="vnsound_outstanding">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <div class="vnsound_title_bg d-none wow slideInUp animated">
            Outstanding Student
          </div>
          <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
            học viên tiểu biểu
          </h2>
        </div>
        <div class="artists_list outstanding_content">

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
                      {{ $items['comments'] }}
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
      </div>
    </div>
  </div>
</div>
<div class="vnsound_landmark">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="vnsound_box_all">
          <div class="vnsound_title_bg d-none wow slideInUp animated">
            landmark event
          </div>
          <h2 class="vnsound_title wow fadeInUp animated" data-wow-delay="0.2s">
            Các sự kiện mang dấu ấn
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="artists_list landmark_list">
    <div class="swiper-container landmark_slide">
      <div class="swiper-wrapper">
        @foreach ($best_events as $item)
        <div class="swiper-slide">
          <div class="outstanding_item">
            <a href="javascript:void(0)" class="landmark_item_img">
              <img src="{{ URL::to('/images/events'). '/'. $item['thumbnail']}}" />
            </a>
          </div>
        </div>

        @endforeach
      </div>
      <div class="swiper-pagination swiper-pagination-landmark"></div>
      <div class="swiper-button-next swiper-button-next-landmark"></div>
      <div class="swiper-button-prev swiper-button-prev-landmark"></div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade proj_da" id="proj_da" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="proj_da_content">
        <div class="proj_da_top">
          <img src="images/ic-popup1.png" alt="" />
          <span>
            Thông tin dự án
          </span>
          <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
            <img src="images/ic-popup2.png" alt="" />
          </a>
        </div>
        <div class="proj_da_body">
          <div class="artists_list proj_da_left">
            <div class="swiper-container proj_da_slide_popup">
              <div class="swiper-wrapper" id="slide_pro">
                {{-- <div class="swiper-slide">
                  <div class="boxdtns_right_slide_img">
                    <img src="images/ss.png" alt="" />
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="boxdtns_right_slide_img">
                    <img src="images/ss.png" alt="" />
                  </div>
                </div> --}}
              </div>
              <!-- <div class="swiper-button-next swiper-button-next-proj_da"></div>
                            <div class="swiper-button-prev swiper-button-prev-proj_da"></div> -->
              <div class="swiper-pagination swiper-pagination-proj_da"></div>
            </div>
          </div>
          <div class="proj_da_right">
            <div class="mttn_left">
              <h3 class="mttn_left_title" id="name_pro">
                {{-- VNSound night<br />
                We’re survivors --}}
              </h3>
              <div class="mttn_left_txt" id="description_pro">
                {{-- <div class="ql-editor" data-gramm="false" contenteditable="true"><p>Thời gian: 05/12/2019		</p><p>Địa điểm: The Opera Club - Hà Nội</p><p>Đánh dấu cột mốc 5 năm gắn liền với sự đổi thay và phát triển của âm nhạc điện tử nước nhà, VNSOUND 5TH ANNIVERSARY là lời tri ân chân thành nhất tới các đối tác, những người bạn đã đồng hành cùng VNSound suốt chặng đường đã qua. Sự kiện diễn ra tại The Opera Nightclub, thu hút gần 700 khán giả tham dự.</p><p><br></p><p><br></p></div><div class="ql-clipboard" contenteditable="true" tabindex="-1"></div> --}}
              </div>
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
$(document).ready(function() {
  $('.ql-editor').removeAttr('contenteditable');

  $('.view_detail').click(function() {
    var id = $(this).data("id");
    const hostName = location.origin;
    $.ajax({
      type: "GET",
      url: "{{ route('home.getById') }}",
      data: {
        id: id
      },
      dataType: 'json',
      success: function(response) {
        console.log($('#description_pro').text());
        $('#name_pro').text(response[0]['name']);
        $('#description_pro').html(response[0]['description']);
        var images = response[0]['images'].split(',');
        for (let i = 0; i < images.length; i++) {
          $('#slide_pro').append(
            "<div class='swiper-slide'>\
                      <div class='boxdtns_right_slide_img'>\
                        <img src= '" + hostName + "/images/events/" + images[i] + "' alt='' />\
                      </div>\
                    </div>"
          );
        }
      }
    });
  });


  $('.proj_da').on('hidden.bs.modal', function(e) {
    $('#slide_pro').empty();
  })

});
// click view detail event
</script>
@endsection