@extends('modules.fontend.layout.index')
@section('css')
<link rel="stylesheet" href="./css/fontend/news.css" />
@endsection
@section('content')


<div class="contact_map">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="map_content">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d232.8205077832433!2d105.8447459!3d20.9875006!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abf359138a4f%3A0x3a4414486d1a5a3c!2sVNSOUND%20STUDIO!5e0!3m2!1svi!2s!4v1687447175398!5m2!1svi!2s"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="contact_form">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="form_content">
          <div class="form_left">
            <form id="main-form" action="{{ route("home.addContact") }}" method="POST">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="form_contact_row">
                <textarea id="description" name="description" class="input_contact_control"
                  placeholder="Nhập nội dung"></textarea>
                @if ($errors->has('description'))
                <script>
                document.getElementById("description").classList.add("is-invalid");
                </script>
                <div class="invalid-feedback" style="display: block;">{{ $errors->first('description') }}</div>
                @endif
              </div>
              <div class="form_contact_row">
                <input class="input_contact_control" id="name" name="name" type="text" placeholder="Tên của bạn" />
                @if ($errors->has('name'))
                <script>
                document.getElementById("name").classList.add("is-invalid");
                </script>
                <div class="invalid-feedback" style="display: block;">{{ $errors->first('name') }}</div>
                @endif
              </div>
              <div class="form_contact_row">
                <input id="email" name="email" class="input_contact_control" type="text" placeholder="Email của bạn" />
                @if ($errors->has('email'))
                <script>
                document.getElementById("email").classList.add("is-invalid");
                </script>
                <div class="invalid-feedback" style="display: block;">{{ $errors->first('email') }}</div>
                @endif
              </div>
              <button type="submit" class="btn btn-submit-btn">
                <span>Gửi</span>
              </button>
            </form>
          </div>
          <div class="form_right">
            <div class="form_right_content">
              <h5>
                {{ $data['lien-he-title'] }}
              </h5>
              <div class="news_main_first_txt">
                {{ $data['lien-he-text'] }}
              </div>
              <div class="form_right_add">
                <div class="form_right_add_item">
                  Hotline: <a href="tel:{{ $data['lien-he-hotline'] }}">{{ $data['lien-he-hotline'] }}</a>
                </div>
                <div class="form_right_add_item">
                  {{ $data['lien-he-address'] }}
                </div>
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