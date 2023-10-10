
@extends('modules.fontend.layout.index')
@section('facebook_meta')
<meta property="og:image" content="http://vnsound.com.vn/images/banner_trang_goi_thieu/banner_top_final.png" />
@endsection
@section('content')
<div class="cd_banner">
    <img class="img-cd1 wow fadeInRight" data-wow-duration="1.5s" src="images/cong-dong/img-cd1.png" alt="" />
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <h1 class="cd_banner_title">
                    <span>Chung tay</span> xây dựng ngôi nhà mới <span>trên TATU</span>
                </h1>
                <div class="banner_content_txt">
                    {{ $data['cong-dong-main-title'] }}
                </div>
                <div class="banner_content_box">
                    <div class="banner_box_first">
                        <span>
                            Xây dựng bởi:
                        </span>
                        <img src="images/logo-banner1.png" alt="" />
                    </div>
                    <a href="{{ route("home.communities") . '#nstnd_dktt' }}" class="btn btn_banner btn_cd_banner">
                        Tham gia ngay<i class="ic-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="cd_banner_right">
                    <img src="images/img-allcd.png" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="nstnd_cdttt">
    <img class="img-cd2 wow fadeInLeft" data-wow-duration="1.5s" src="images/cong-dong/img-cd2.png" alt="" />
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dg_title wow fadeInLeft" data-wow-duration="1.5s">
                    <h2 class="tatu_title">
                        Nhóm/kênh cộng đồng<br />
                        trên TATU có thể làm được
                    </h2>
                </div>
                <div class="dg_list wow fadeInLeft" data-wow-duration="1.5s">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="towards_item">
                                <h3>
                                    01/
                                </h3>
                                <div class="sub">
                                    {{ $data['cong-dong-main-content-1'] }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="towards_item">
                                <h3>
                                    02/
                                </h3>
                                <div class="sub">
                                    {{ $data['cong-dong-main-content-2'] }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="towards_item">
                                <h3>
                                    03/
                                </h3>
                                <div class="sub">
                                    {{ $data['cong-dong-main-content-3'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="nstnd_cddt">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bcvct_title wow fadeInLeft" data-wow-duration="1.5s">
                    <h2 class="tatu_title">
                        Cộng đồng đầu tiên TATU
                    </h2>
                    <div class="bcvct_btn">
                        <div class="swiper-button-next swiper-button-next-cddt" tabindex="0" role="button"
                             aria-label="Next slide" aria-disabled="false"></div>
                        <div class="swiper-button-prev swiper-button-prev-cddt" tabindex="-1" role="button"
                             aria-label="Previous slide" aria-disabled="true"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>

    </div>
    <div class="bcvct_list wow fadeInLeft" data-wow-duration="1.5s">
        <div class="swiper-container cddt_slide">
            <div class="swiper-wrapper">
                @foreach($listGroupCom as $communities)
                    <div class="swiper-slide">
                        <div class="creators_cdst">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="cdst_all">
                                        <div class="row">
                                            <div class="col-lg-6 col-6">
                                                @if(isset($communities[1]))
                                                    <div class="cdst_item">
                                                        <img src="{{ URL::to('/images/sliders'). '/'. $communities[1]->image}}" alt="" />
                                                        <div class="cdst_item_txt">
                                                        <span>
                                                            {{ $communities[1]->title }}
                                                        </span>
                                                            {{ $communities[1]->sub_title }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6 col-6">
                                                @if(isset($communities[2]))
                                                    <div class="cdst_item">
                                                        <img src="{{ URL::to('/images/sliders'). '/'. $communities[2]->image}}" alt="" />
                                                        <div class="cdst_item_txt">
                                                        <span>
                                                            {{ $communities[2]->title }}
                                                        </span>
                                                            {{ $communities[2]->sub_title }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                @if(isset($communities[3]))
                                                    <div class="cdst_item cdst_item2">
                                                        <img src="{{ URL::to('/images/sliders'). '/'. $communities[3]->image}}" alt="" />
                                                        <div class="cdst_item_txt">
                                                        <span>
                                                            {{ $communities[3]->title }}
                                                        </span>
                                                            {{ $communities[3]->sub_title }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="cdst_all">
                                        <div class="row">
                                            <div class="col-lg-6 col-6">
                                                @if(isset($communities[4]))
                                                    <div class="cdst_item cdst_item3" >
                                                        <img src="{{ URL::to('/images/sliders'). '/'. $communities[4]->image}}" alt="" />
                                                        <div class="cdst_item_txt">
                                                        <span>
                                                            {{ $communities[4]->title }}
                                                        </span>
                                                            {{ $communities[4]->sub_title }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6 col-6">
                                                <div class="cdst_item_other">
                                                    @if(isset($communities[5]))
                                                        <div class="cdst_item">
                                                            <img src="{{ URL::to('/images/sliders'). '/'. $communities[5]->image}}" alt="" />
                                                            <div class="cdst_item_txt">
                                                            <span>
                                                                {{ $communities[5]->title }}
                                                            </span>
                                                                {{ $communities[5]->sub_title }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(isset($communities[6]))
                                                        <div class="cdst_item">
                                                            <img src="{{ URL::to('/images/sliders'). '/'. $communities[6]->image}}" alt="" />
                                                            <div class="cdst_item_txt">
                                                            <span>
                                                                {{ $communities[6]->title }}
                                                            </span>
                                                                {{ $communities[6]->sub_title }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- <div class="swiper-pagination swiper-pagination-cddt"></div> -->
        </div>
    </div>
    <div class="th_list_mb">
        <div class="swiper-container cdst_slide2">
            <div class="swiper-wrapper">
                @foreach($listCommunities as $com)
                    <div class="swiper-slide">
                        <div class="cdst_item">
                            <img src="{{ URL::to('/images/sliders'). '/'. $com->image_mobile}}" alt="" />
                            <div class="cdst_item_txt">
                                <span>
                                {{ $com->title }}
                                </span>
                                {{ $com->sub_title }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination swiper-pagination-cdst2"></div>
        </div>
    </div>
</div>
<div class="nstnd_dktt" id="nstnd_dktt">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dktt_title wow fadeInLeft" data-wow-duration="1.5s">
                    <h2 class="tatu_title">
                        Đăng ký trở thành nhà sáng tạo
                    </h2>
                </div>
                <div class="dktt_form wow fadeInLeft" data-wow-duration="1.5s">
                    <form action="{{ route("home.addNst") }}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <h3>
                            Lời nói là tài sản - Voice is money!
                        </h3>
                        <div class="dktt_form_row">
                            <input type="text" name="name" placeholder="Họ và tên" />
                        </div>
                        <div class="dktt_form_row">
                            <input type="text" name="phone" placeholder="Số điện thoại" />
                        </div>
                        <div class="dktt_form_row">
                            <input type="text" name="email" placeholder="Gmail" />
                        </div>
                        <div class="dktt_form_row">
                            <input type="text" name="specialize" placeholder="Chuyên môn" />
                        </div>
                        <div class="dktt_form_row">
                            <input type="text" name="experience" placeholder="Kinh nghiệm (Không bắt buộc)" />
                        </div>
                        <div class="dktt_form_box">
                            <button type="submit" class="btn btn_banner">
                                Đăng ký
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('title')

@endsection