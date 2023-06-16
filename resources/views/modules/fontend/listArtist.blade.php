
@extends('modules.fontend.layout.index')
@section('content')
   
<div class="vnsound_banner banner_introduct banner_pfartist">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner_content">
                    <h1 class="banner_title wow fadeInUp animated">
                        profile nghệ sỹ
                    </h1>
                    <div class="banner_txt wow fadeInUp animated" data-wow-delay="0.3s">
                        Rock off and rave on
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pfartist_list">
    <div class="container">
        <div class="row">
            @foreach ($items as $item)
            <div class="col-md-4 col-sm-6">
                <a href="{{ route('home.artistDetail', ['id' => $item['id']]) }}" class="artists_item wow flipInY animated animated"
                    style="visibility: visible; animation-name: flipInY;">
                    <img src="{{ URL::to('/images/artists'). '/'. $item['images']}}" />
                    <span class="artists_item_name">
                        {{ $item['name'] }}
                    </span>
                </a>
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
        $(document).ready(function(){
            $('#select-files').click(function () {
                console.log('test')
                $('#certificate').click()
                return false
            })
            $('#submitForm').click(function () {
                $('#main-form').submit()
            })
        })
    </script>

@endsection
