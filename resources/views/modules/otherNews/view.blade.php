@extends('layouts/detachedLayoutMaster')

@section('title', 'Blog Detail')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('css/base/pages/page-blog.css') }}" />
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
  <style>
    .ql-hidden{
      display: none;
    }
    img{
      max-width: 100%;
    }
  </style>
@endsection

@section('content')
  <!-- Blog Detail -->
  <div class="blog-detail-wrapper">
    <div class="row">
      <!-- Blog -->
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">{{ $item->title }}</h4>
            <div class="media">
              <div class="media-body">
                <small class="text-muted">{{ $item->updated_at }}</small>
              </div>
            </div>
            <p class="card-text mb-2">
              {!! $item->description !!}
            </p>
          </div>
        </div>
      </div>
      <!--/ Blog -->
    </div>
  </div>
  <!--/ Blog Detail -->
@endsection
