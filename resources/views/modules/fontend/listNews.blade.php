
@extends('modules.fontend.layout.index')
@section('content')

<div class="news_main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if (isset($hotNews[0]))
                    <div class="news_main_first">
                        <a href="{{ route("home.news", ["slug" => $hotNews[0]['slug']]) }}" class="news_main_first_img">
                            <img src="{{ URL::to('/images/news'). '/'. $hotNews[0]['images'] }}" />
                        </a>
                        <a href="{{ route("home.news", ["slug" => $hotNews[0]['slug']]) }}" class="news_main_first_title">
                            {{ $hotNews[0]['title'] }}
                        </a>
                        <div class="news_main_first_txt">
                            {{ $hotNews[0]['sub_title'] }}
                        </div>
                    </div>
                @endif
                <div class="news_list">
                    <div class="row">
                        @foreach ($items as $item)
                            <div class="col-md-4">
                                <div class="knowledge_item">
                                    <div class="knowledge_item_img wow flipInY animated animated animated"
                                        style="visibility: visible; animation-name: flipInY;">
                                        <img src="{{ URL::to('/images/news'). '/'. $item['images']}}" />
                                    </div>
                                    <div class="knowledge_item_body">
                                        <div class="knowledge_item_date">
                                            {{ $item['ngay_sua'] }}
                                        </div>
                                        <a href="{{ route("home.news", ["slug" => $item['slug']]) }}" class="knowledge_item_title">
                                            {{ $item['title'] }}
                                        </a>
                                        <a class="knowledge_item_links" href="{{ route("home.news", ["slug" => $item['slug']]) }}">
                                            Xem thêm
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="d-flex">
                        <div class="mx-auto">
                            {{$items->links("pagination::bootstrap-4")}}
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