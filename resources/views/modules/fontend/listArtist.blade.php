@extends('modules.fontend.layout.index')
@section('facebook_meta')
<meta property="og:image" content="http://vnsound.com.vn/images/banner_trang_goi_thieu/banner_top_final.png" />
@endsection
@section('content')

  <div class="vnsound_banner banner_introduct banner_pfartist">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="banner_content">
                      <h1 class="banner_title wow fadeInUp animated">
                          nghệ sỹ
                      </h1>
                      <div class="banner_txt wow fadeInUp animated" data-wow-delay="0.3s">
                          "Build up your name"
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <form action="{{ route('home.artists') }}" method="GET">
      <div class="row align-items-center d-flex justify-content-center bg-center-not py-4">
          <label class="mb-0 text-white font-08rem">Chọn nghệ sĩ</label>
          <div class="col-sm-3">
              <select class="select2 form-control form-control-lg font-08rem" name="id" id="id">
                  <option value="">-- Chọn --</option>
                  @foreach ($list_artists as $item)
                      <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                  @endforeach
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Lọc</button>
      </div>
      </div>
      <div class="pfartist_list">
          <div class="container">
              <div class="row">
                  @if (empty(request('id')))
                      @foreach ($items as $item)
                          <div class="col-md-4 col-sm-6">
                              <a href="{{ route('home.artistDetail', ['slug' => $item['slug']]) }}"
                                  class="artists_item wow flipInY animated animated"
                                  style="visibility: visible; animation-name: flipInY;">
                                  <img src="{{ URL::to('/images/artists') . '/' . $item['images'] }}" />
                                  <span class="artists_item_name">
                                      {{ $item['name'] }}
                                  </span>
                              </a>
                          </div>
                      @endforeach
                  @else
                      <div class="col-md-4 col-sm-6">
                          <a href="{{ route('home.artistDetail', ['slug' => $items['slug']]) }}"
                              class="artists_item wow flipInY animated animated"
                              style="visibility: visible; animation-name: flipInY;">
                              <img src="{{ URL::to('/images/artists') . '/' . $items['images'] }}" />
                              <span class="artists_item_name">
                                  {{ $items['name'] }}
                              </span>
                          </a>
                      </div>
                  @endif
              </div>
              <div class="d-flex">
                  <div class="mx-auto">
                      @if (empty($_GET['id']))
                          {{ $items->links('pagination::bootstrap-4') }}
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </form>

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
        $('#select-files').click(function() {
            console.log('test')
            $('#certificate').click()
            return false
        })
        $('#submitForm').click(function() {
            $('#main-form').submit()
        })
    })
  </script>
@endsection
