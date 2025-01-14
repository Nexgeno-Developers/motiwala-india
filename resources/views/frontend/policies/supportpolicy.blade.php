@extends('frontend.layouts.app')

@section('meta_title'){{ $page->meta_title }}@stop

@section('meta_description'){{ $page->meta_description }}@stop

@section('meta_keywords'){{ $page->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $page->meta_title }}">
    <meta itemprop="description" content="{{ $page->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($page->meta_image) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="website">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $page->meta_title }}">
    <meta name="twitter:description" content="{{ $page->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($page->meta_image) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $page->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ URL($page->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($page->meta_image) }}" />
    <meta property="og:description" content="{{ $page->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')
<!-- <section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ $page->getTranslation('title') }}</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item has-transition opacity-50 hov-opacity-100">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        "{{ translate('Support Policy') }}"
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section> -->

<section class="breadcrums_sedction breacrums_bg">
    <div class="container">
    <!-- Breadcrumb -->
     <h4 class="text-white text-center">About Us</h4>
        <ul class="breadcrumb bg-transparent py-0 px-1 justify-content-center">
            <li class="breadcrumb-item fs-18">
                <a class="text-white" href="{{ route('home') }}">{{ translate('Home')}}</a>
            </li>
            <li class="fs-18 text-white fw-400 breadcrumb-item">
            <span>About Us</span>
            </li>
        </ul>
    </div>
</section>


<!-- <section class="mb-4">
    <div class="container">
        <div class="p-4 bg-white rounded shadow-sm overflow-hidden mw-100 text-left">
            @php
                echo $page->getTranslation('content');
            @endphp
        </div>
    </div>
</section> -->

<section class="about_section mt-md-5 mt-4 org_bg_light">
    <div class="row align-items-center">
          <div class="col-md-6 p-md-0">
            <div class="mb-md-0 mb-3">
                  <video class="embed-responsive embed-responsive-16by9" autoplay="" muted="" loop="" id="myVideo2">
                        <source src="{{ static_asset('assets/img/video/about_video_1.mp4') }}" type="video/mp4">
                    </video>
            </div>
        </div>

        <div class="col-md-6 p-md-0">
            <div class="about_content_sec pl-md-5 pr-md-5">
                <h3 class="main_heading text_clr_green pb-md-3">About Lab Grown Jewelry</h3>
                
                <p class="about_content_para2"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley o  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1</p>
                
                <p class="mb-0 pb-0"><strong>"My Jewellery is here to celebrate life with you"</strong></p>
                
            </div>
        </div>
          
    </div>
</section>

<section class="about_section org_bg_light">
    <div class="row align-items-center">
        <div class="col-md-6 p-md-0 order-md-1 order-2">
            <div class="about_content_sec pl-md-5 pr-md-5">
                <h3 class="main_heading text_clr_green pb-md-3">Our Story</h3>
                
                <p class="about_content_para2"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley o  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has</p>
                
                <p class="about_content_para2"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley o  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has</p>
                
                <p class="mb-0 pb-0"><strong>"What are you celebrating today?"</strong></p>
                
            </div>
        </div>
            <div class="col-md-6 p-md-0 order-md-2 order-1">
            <div class="mb-md-0 mb-3">
                <img class="w-100" src="{{ static_asset('assets/img/our_story_image.webp') }}" />
            </div>
        </div>
    </div>
</section>

<div class="video_section mt-md-5 mt-4 mb-md-5 mb-4">
    <video class="embed-responsive embed-responsive-16by9" autoplay="" muted="" loop="" id="myVideo2">
                        <source src="{{ static_asset('assets/img/video/about_video_2.mp4') }}" type="video/mp4">
                    </video>
</div>


<section class="about_section org_bg_light">
    <div class="row align-items-center">
          <div class="col-md-6 p-md-0">
            <div class="mb-md-0 mb-3">
                <img class="w-100" src="{{ static_asset('assets/img/founder_image.webp') }}" />
            </div>
        </div>

        <div class="col-md-6 p-md-0">
            <div class="about_content_sec pl-md-5 pr-md-5">
                <h3 class="main_heading text_clr_green pb-md-3">Our Founder</h3>
                
                <p class="about_content_para2"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley o  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has</p>
                <p class="about_content_para2"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever sinc</p>
                
                <p class="mb-0 pb-0"><strong>"Embrace more, embrace better, embrace the future"</strong></p>
                
            </div>
        </div>
          
    </div>
</section>

<section class="about_section org_bg_light">
    <div class="row align-items-center">
        <div class="col-md-6 p-md-0 order-md-1 order-2">
            <div class="about_content_sec pl-md-5 pr-md-5">
                <h3 class="main_heading text_clr_green pb-md-3">Sustainability</h3>
                
                <p class="about_content_para2"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley o  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1  is simply dummy text of the printing and typesetting industry. </p>
                
                <p class="mb-0 pb-0"><strong>"My Jewellery is here to celebrate life with you"</strong></p>
                
            </div>
        </div>
            <div class="col-md-6 p-md-0 order-md-2 order-1">
            <div class="mb-md-0 mb-3">
                <img class="w-100" src="{{ static_asset('assets/img/sustainibility.webp') }}" />
            </div>
        </div>
    </div>
</section>

@endsection
