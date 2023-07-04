<!DOCTYPE html>
<html lang="en">

<head>
  <base href="{{ asset('') }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  @yield('facebook_meta')
  <!-- <meta property="og:image" content="" /> -->
  <title>VNSOUND</title>
  <!--Meta view -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!--Font Awesome-->
  <link rel="stylesheet" href="./fontend/style/font-awesome.min.css" />
  <!--Jquery UI-->
  <link rel="stylesheet" href="./fontend/style/jquery-ui.css" />
  <!--Bootstrap 4-->
  <link rel="stylesheet" href="./fontend/style/bootstrap/dist/css/bootstrap.min.css" />
  <!--CSS-->
  <link href="./fontend/style/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
  <link href="./fontend/style/animate.css" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" rel="stylesheet"
    type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" rel="stylesheet"
    type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/ajax-loader.gif" rel="stylesheet"
    type="text/css" />
  <link href="./fontend/style/vn-sound-css.css" rel="stylesheet" type="text/css" />

  @yield('css')
</head>

<body>
  <div class="tatu_all">

    <!-- header -->
    @include('modules.fontend.layout.navbar')
    <!-- end header -->
    <!-- Content -->
    @yield('content')
    <!-- END Content-->
    <!-- Footer-->
    @include('modules.fontend.layout.footer')
    <!-- END Footer-->


    <script type="text/javascript" src="./js/fontend/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="./js/fontend/jquery-ui.js"></script>
    <script type="text/javascript" src="./js/fontend/bootstrap.min.js"></script>
    <script type="text/javascript" src="./fontend/js/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="./fontend/js/wow.min.js"></script>
    <script type="text/javascript" src="./fontend/js/enquire.min.js"></script>
    <script type="text/javascript" src="./fontend/js/easing.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">
    </script>
    <script type="text/javascript" src="./fontend/js/main.js"></script>
    <script>
    $(document).ready(function() {
      $(".ql-editor").removeAttr("contenteditable")
      $(".ql-clipboard").removeAttr("contenteditable")
    });
    </script>

    @yield('script')

  </div>

</body>

</html>