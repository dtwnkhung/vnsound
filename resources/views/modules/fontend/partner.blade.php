
@extends('modules.fontend.layout.index')
@section('facebook_meta')
<meta property="og:image" content="http://vnsound.com.vn/images/banner_trang_goi_thieu/banner_top_final.png" />
@endsection
@section('css')
    <link rel="stylesheet" href="./css/fontend/news.css" />
@endsection
@section('content')
    <!-- Tìm kiếm gia sư-->
    <section class="master-search mt-partner mt-70">
        <div class="container">
            <div class="master-search__information text-center">
                <form class="form-horizontal form" id="main-form" action="{{ route('home.teachers') }}" method="GET" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <img src="fontend/media/home_page/search-icon.svg" alt="search">
                        <input type="text" id="input-search" class="form-control" placeholder="Tìm Tên Gia Sư..." name="text-search" value="{{ $text_search }}"
                               aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="btn-search-master">
                            <button class="btn btn-outline-success h-52" type="submit" id="button-search">Tìm kiếm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!--Danh sách gia sư chi tiết-->

    <section class="master-introduction mt-partner mt-36">
        <div class="container">
            @if(count($teachers) > 0)
            <div class="row">
                @foreach($teachers as $teacher)
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-master-custom">
                    <div class="master-introduction__information">
                        <div class="box-master-introduction__heading">
                            <div class="box-tutor-team__avatar d-flex align-items-center">
                                <div class="box-tutor__avatar">
                                    <img src="{{ URL::to('/images/teachers'). '/'. $teacher->images}}"
                                         alt="tutor_avatar" style="max-width: 75px"/>
                                </div>
                                <div class="box-tutor__desc ml-4">
                                    <p class="box-tutor__name">{{ $teacher->name }}</p>
                                    @php
                                        $class = App\Models\Product::find($teacher->class);
                                                if($class){
                                                    echo '<p class="box-tutor__master">'.$class['name'].'</p>';
                                                }
                                    @endphp
                                </div>
                            </div>
                            <div class="box-tutor__border border-green"></div>
                            <div class="box-tutor-team__information">
                                <div class="box-tutor-team__education d-flex align-items-baseline">
                                    <p class="box-tutor__master">Học vấn :</p>
                                    <p class="box-tutor__name pl-1">{{ $teacher->education }}</p>
                                </div>
                                <div class="box-tutor-team__experience d-flex align-items-baseline">
                                    <p class="box-tutor__master">Kinh nghiệm :</p>
                                    <p class="box-tutor__name">{{ $teacher->experience }}</p>
                                </div>
                                <div class="box-tutor-team__detail text-green-edu">
                                    <a class="text-green-edu" href="{{ route('home.teacherDetail', ['id' => $teacher->id]) }}"> Xem profile gia sư</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex">
                <div class="mx-auto">
                    {{$teachers->links("pagination::bootstrap-4")}}
                </div>
            </div>
            @else
                <div class="text-center">
                    <h2>Không có dữ liệu</h2>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('title')

@endsection
@section('script')

@endsection