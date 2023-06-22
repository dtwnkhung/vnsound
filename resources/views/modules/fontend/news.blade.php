@extends('modules.fontend.layout.index')
@section('content')
<style>
img {
  width: 100%;
}

p {
  line-height: 25px;
}
</style>
<div class="vnsound_banner banner_news">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner_content">
          <h1 class="banner_title wow fadeInUp animated">
            tin tức
          </h1>
          <div class="banner_txt wow fadeInUp animated" data-wow-delay="0.3s">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="text-decoration:underline" href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a style="text-decoration:underline" href="/tin-tuc.html">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tin chi tiết</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="news_main" style="margin-top:0">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="news_main_first">
          <a href="javascript:void(0)" class="news_main_first_img">
            <img src="{{ URL::to('/images/news'). '/'. $news->images[0]}}" alt="new_feed" class="w-100 center-img" />
          </a>
          <a href="javascript:void(0)" class="news_main_first_title">
            {{ $news->title }}
          </a>
          <div class="news_main_first_txt">
            {!! $news->description !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('title')

@endsection