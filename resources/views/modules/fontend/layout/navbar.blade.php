<header class="box_header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="box_header_content sm-pt10">
          <div class="de-flex-col">
            <!-- logo begin -->
            <div class="logo-vns">
              <a href="">
                <img alt="" src="images/logo-main.png" class="img-fluid" style="height:45px" />
              </a>
            </div>
            <!-- logo close -->
          </div>
          <div class="de-flex-col header-col-mid">
            <!-- mainmenu begin -->

            @php
            if(!isset($activeHome)){
            $activeHome = '';
            }
            if(!isset($activeIntroduce)){
            $activeIntroduce = '';
            }
            if(!isset($activeTeacher)){
            $activeTeacher = '';
            }
            if(!isset($activeProduct)){
            $activeProduct = '';
            }
            if(!isset($activeNews)){
            $activeNews = '';
            }
            if(!isset($activeContact )){
            $activeContact = '';
            }
            if(!isset($activeKnowledges )){
            $activeKnowledges = '';
            }
            if(!isset($activeArtist )){
            $activeArtist = '';
            }


            @endphp
            <ul id="mainmenu">
              <li>
                <a href="/" class="{{ $activeHome }}">Trang chủ</a>
              </li>
              <li><a href="{{ route('home.introduce') }}" class="{{ $activeIntroduce }}">Giới thiệu</a></li>
              <li>
                <a href="javascript:void(0)" class="{{ $activeProduct }}">Khóa học</a>
                <ul>
                  @foreach ($dataShare['products'] as $item)
                  <li><a href="{{ route('home.products', ['id' => $item['id']]) }}">{{ $item['name'] }}</a></li>
                  @endforeach
                </ul>
              </li>
              <li><a href="{{ route('home.artists') }}" class="{{ $activeArtist }}">Nghệ sỹ</a></li>
              <li><a href="{{ route('home.listnews') }}" class="{{ $activeNews }}">Tin tức</a></li>
              <li>
                <a href="{{ route('home.knowledges') }}" class="{{ $activeKnowledges }}">Kiến thức</a>
              </li>
              <li>
                <a href="{{ route('home.library') }}">Thư viện</a>
              </li>
              <li>
                <a href="{{ route('home.contact') }}">Liên hệ</a>
              </li>
            </ul>
          </div>
          <div class="de-flex-col">
            <div class="menu_side_area">
              <a href="javascript:void(0)" class="btn btn-main" data-toggle="modal" data-target="#proj_follow">
                <span>Đăng ký ngay</span>
              </a>
              <span id="menu-btn">
                <img src="images/ic-2.png" alt="" />
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->

</header>
<div class="modal fade proj_da proj_follow" id="proj_follow" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="proj_da_content">
        <div class="proj_da_top">
          <img src="images/ic-popup1.png" alt="" />
          <span>
            vui lòng liên hệ
          </span>
          <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
            <img src="images/ic-popup2.png" alt="" />
          </a>
        </div>
        <div class="proj_da_body">
          <div class="artists_list proj_follow_left">
            <div class="proj_follow_left_img">
              <img src="{{ URL::to('/images/components'). '/'. $dataShare['contac-popup-image']}}" />
            </div>
          </div>
          <div class="proj_follow_right">
            <div class="proj_follow_right_name">
              <span class="proj_follow_name">
                {{ $dataShare['contac-popup-name'] }}
              </span>
              <span class="proj_follow_vt">
                {{ $dataShare['contac-popup-pos'] }}
              </span>
            </div>
            <div class="proj_follow_right_info">
              {{ $dataShare['contac-popup-email'] }} | {{ $dataShare['contac-popup-phone'] }}
            </div>
            <div class="proj_follow_right_info_txt">
              {{ $dataShare['contac-popup-text'] }}
            </div>
          </div>
        </div>
        <div class="proj_follow_bot">
          <div class="proj_follow_bot_mxh">
            <span>SOCIAL LINKS:</span>
            <a href="{{ $dataShare['contac-popup-facebook'] }}">
              <img src="images/ic-follow1.png" alt="" />
            </a>
            <a href="{{ $dataShare['contac-popup-zalo'] }}">
              <img src="images/ic-follow2.png" alt="" />
            </a>
            <!-- <a href="{{ $dataShare['contac-popup-mess'] }}">
                                <img src="images/ic-follow3.png" alt="" />
                            </a> -->
            <a href="lien-he.html" target="_blank">
              <img src="images/ic-follow3.png" alt="" />
            </a>
          </div>
          <div class="proj_follow_bot_txt">
            vn Sound@music VietNam
          </div>
        </div>
      </div>
    </div>
  </div>
</div>