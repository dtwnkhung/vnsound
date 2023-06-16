
@extends('modules.fontend.layout.index')
@section('content')
    <div class="container mt-3 product-container">
        <div class="d-flex align-items-center justify-content-between py-4 results">
            <h3 class="section-title">Dự án</h3>
        </div>
        <div class="row">
            @foreach($items as $key => $news)
                <div class="col-sm-4 col-lg-4 col-md-6">
                    <div class="widget single-news">
                        <div class="image">
                            <a href="{{ route("home.news", $news['slug']) }}">
                                <img src="{{ URL::to('/images/news'). '/600x400-'. $news['images']}}" class="img-responsive">
                            </a>
                            <span class="gradient"></span>
                        </div>
                        <div class="details">
                            <div class="category"><a href="javascript:void(0)">News</a></div>
                            <h3><a href="{{ route("home.news", $news['slug']) }}">{{ $news['title'] }}</a></h3>
                            <time>{{ $news['updated_at'] }}</time>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        body{
            margin-top:20px;
            background-color: #eee;
        }

        a:hover{
            text-decoration:none;
        }

        .widget.single-news {
            margin-bottom: 20px;
            position: relative;
        }

        .widget.single-news .image img {
            display: block;
            width: 100%;
        }

        .widget.single-news .image .gradient {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgeG1sbnM9Imh0d…IxIiBoZWlnaHQ9IjEiIGZpbGw9InVybCgjbGVzc2hhdC1nZW5lcmF0ZWQpIiAvPjwvc3ZnPg==);
            background-image: -webkit-linear-gradient(bottom, #000000 0%, rgba(0, 0, 0, 0.05) 100%);
            background-image: -moz-linear-gradient(bottom, #000000 0%, rgba(0, 0, 0, 0.05) 100%);
            background-image: -o-linear-gradient(bottom, #000000 0%, rgba(0, 0, 0, 0.05) 100%);
            background-image: linear-gradient(to top, #000000 0%, rgba(0, 0, 0, 0.05) 100%);
        }

        .widget.single-news .details {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
        }

        .widget.single-news .details .category {
            font-size: 11px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .widget.single-news .details .category a {
            color: #fff;
            zoom: 1;
            -webkit-opacity: 0.5;
            -moz-opacity: 0.5;
            opacity: 0.5;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
            filter: alpha(opacity=50);
        }

        .widget.single-news .details h3 {
            margin: 0;
            padding: 0;
            margin-bottom: 10px;
            font-size: 19px;
        }

        .widget.single-news .details h3 a {
            color: #fff;
            zoom: 1;
            -webkit-opacity: 0.8;
            -moz-opacity: 0.8;
            opacity: 0.8;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
            filter: alpha(opacity=80);
        }

        .widget.single-news .details:hover time {
            position: relative;
            display: block;
            color: #fff;
            font-size: 13px;
            margin-bottom: -20px;
            -webkit-transition: all 350ms cubic-bezier(0.175, 0.885, 0.320, 1.275);
            -moz-transition: all 350ms cubic-bezier(0.175, 0.885, 0.320, 1.275);
            -o-transition: all 350ms cubic-bezier(0.175, 0.885, 0.320, 1.275);
            transition: all 350ms cubic-bezier(0.175, 0.885, 0.320, 1.275);
            zoom: 1;
            -webkit-opacity: 0;
            -moz-opacity: 0;
            opacity: 0;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
            filter: alpha(opacity=0);
        }
    </style>
@endsection

@section('title')

@endsection