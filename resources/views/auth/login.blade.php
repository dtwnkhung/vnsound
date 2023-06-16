@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-v1 px-2">
  <!-- Basic toast -->
  <div
          class="toast toast-basic hide position-fixed"
          role="alert"
          aria-live="assertive"
          aria-atomic="true"
          data-delay="5000"
          style="top: 1rem; right: 1rem"
  >
    <div class="toast-header">
      <strong class="mr-auto">Thông báo</strong>
      <button type="button" class="ml-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body text-success">{{ session('thongbao') }}</div>
  </div>
  <div class="auth-inner py-2">
    <!-- Login v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="javascript:void(0);" class="brand-logo">
          <h2 class="brand-text text-primary ml-1">VNSOUND</h2>
        </a>

        <h4 class="card-title mb-1">Welcome to VNSOUND! 👋</h4>

        <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label for="login-email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="login-email" name="email" placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus value="{{ old('email') }}" />
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="login-password">Password</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
              <div class="input-group-append">
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
        </form>
        </div>
      </div>
    </div>
    <!-- /Login v1 -->
  </div>
</div>
<script type="text/javascript"  src="./js/fontend/jquery-3.5.1.min.js"></script>
@if (session('thongbao'))
  <script>
    $(document).ready(function(){
      $('.toast-basic').toast('show');
    });
  </script>
@endif
@endsection
