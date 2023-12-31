@extends('layouts/detachedLayoutMaster')

@section('title', 'Blog Detail')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('css/base/pages/page-blog.css') }}" />
@endsection

@section('content')
  <!-- Blog Detail -->
  <div class="blog-detail-wrapper">
    <div class="row">
      <!-- Blog -->
      <div class="col-12">
        <div class="card">
          <img src="{{ asset('images/banner/banner-12.jpg') }}" class="img-fluid card-img-top" alt="Blog Detail Pic" />
          <div class="card-body">
            <h4 class="card-title">The Best Features Coming to iOS and Web design</h4>
            <div class="media">
              <div class="avatar mr-50">
                <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="Avatar" width="24" height="24" />
              </div>
              <div class="media-body">
                <small class="text-muted mr-25">by</small>
                <small><a href="javascript:void(0);" class="text-body">Ghani Pradita</a></small>
                <span class="text-muted ml-50 mr-25">|</span>
                <small class="text-muted">Jan 10, 2020</small>
              </div>
            </div>
            <div class="my-1 py-25">
              <a href="javascript:void(0);">
                <div class="badge badge-pill badge-light-danger mr-50">Gaming</div>
              </a>
              <a href="javascript:void(0);">
                <div class="badge badge-pill badge-light-warning">Video</div>
              </a>
            </div>
            <p class="card-text mb-2">
              Before you get into the nitty-gritty of coming up with a perfect title, start with a rough draft: your
              working title. What is that, exactly? A lot of people confuse working titles with topics. Let's clear that
              Topics are very general and could yield several different blog posts. Think "raising healthy kids," or
              "kitchen storage." A writer might look at either of those topics and choose to take them in very, very
              different directions.A working title, on the other hand, is very specific and guides the creation of a
              single blog post. For example, from the topic "raising healthy kids," you could derive the following working
              title See how different and specific each of those is? That's what makes them working titles, instead of
              overarching topics.
            </p>
            <h4 class="mb-75">Unprecedented Challenge</h4>
            <ul class="p-0 mb-2">
              <li class="d-block">
                <span class="mr-25">-</span>
                <span>Preliminary thinking systems</span>
              </li>
              <li class="d-block">
                <span class="mr-25">-</span>
                <span>Bandwidth efficient</span>
              </li>
              <li class="d-block">
                <span class="mr-25">-</span>
                <span>Green space</span>
              </li>
              <li class="d-block">
                <span class="mr-25">-</span>
                <span>Social impact</span>
              </li>
              <li class="d-block">
                <span class="mr-25">-</span>
                <span>Thought partnership</span>
              </li>
              <li class="d-block">
                <span class="mr-25">-</span>
                <span>Fully ethical life</span>
              </li>
            </ul>
            <div class="media">
              <div class="avatar mr-2">
                <img src="{{ asset('images/portrait/small/avatar-s-6.jpg') }}" width="60" height="60" alt="Avatar" />
              </div>
              <div class="media-body">
                <h6 class="font-weight-bolder">Willie Clark</h6>
                <p class="card-text mb-0">
                  Based in London, Uncode is a blog by Willie Clark. His posts explore modern design trends through photos
                  and quotes by influential creatives and web designer around the world.
                </p>
              </div>
            </div>
            <hr class="my-2" />
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center mr-1">
                  <a href="javascript:void(0);" class="mr-50">
                    <i data-feather="message-square" class="font-medium-5 text-body align-middle"></i>
                  </a>
                  <a href="javascript:void(0);">
                    <div class="text-body align-middle">19.1K</div>
                  </a>
                </div>
                <div class="d-flex align-items-center">
                  <a href="javascript:void(0);" class="mr-50">
                    <i data-feather="bookmark" class="font-medium-5 text-body align-middle"></i>
                  </a>
                  <a href="javascript:void(0);">
                    <div class="text-body align-middle">139</div>
                  </a>
                </div>
              </div>
              <div class="dropdown blog-detail-share">
                <i
                        data-feather="share-2"
                        class="font-medium-5 text-body cursor-pointer"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                ></i>
                <div class="dropdown-menu dropdown-menu-right">
                  <a href="javascript:void(0);" class="dropdown-item py-50 px-1">
                    <i data-feather="github" class="font-medium-3"></i>
                  </a>
                  <a href="javascript:void(0);" class="dropdown-item py-50 px-1">
                    <i data-feather="gitlab" class="font-medium-3"></i>
                  </a>
                  <a href="javascript:void(0);" class="dropdown-item py-50 px-1">
                    <i data-feather="facebook" class="font-medium-3"></i>
                  </a>
                  <a href="javascript:void(0);" class="dropdown-item py-50 px-1">
                    <i data-feather="twitter" class="font-medium-3"></i>
                  </a>
                  <a href="javascript:void(0);" class="dropdown-item py-50 px-1">
                    <i data-feather="linkedin" class="font-medium-3"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Blog -->
    </div>
  </div>
  <!--/ Blog Detail -->
@endsection
