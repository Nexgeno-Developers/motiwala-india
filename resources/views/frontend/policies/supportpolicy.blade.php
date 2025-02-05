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
<!-- 
<section class="breadcrums_sedction breacrums_bg" style="background-image: url('{{ static_asset('assets/img/header_bg_img.webp') }}');">
    <div class="container">

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
</section> -->


<!-- <section class="mb-4">
    <div class="container">
        <div class="p-4 bg-white rounded shadow-sm overflow-hidden mw-100 text-left">
            @php
                echo $page->getTranslation('content');
            @endphp
        </div>
    </div>
</section> -->

<section class="about_sections about_bg1" style="background-image: url('{{ static_asset('assets/img/about_bg_image.webp') }}');">
    <div class="container position-relative">
        <div class="row align-items-center">
              <div class="col-md-5 order-md-1 order-2">
                <div class="pt-md-0 pt-4 pb-md-0 pb-4">
                    <h4 class="main_heading text-white pb-md-2">About <span class="d-md-block">Motiwala & Sons</span></h4>
                    <p class="text-white mb-md-3 mb-0">-</p>
                   
                </div>
            </div>
            <div class="col-md-6 order-md-2 order-1 pl-md-5">
                <div class="">
                    <img class="profile_img_box" src="{{ static_asset('assets/img/about_profile_image.webp') }}" />
                </div>
            </div>
            <div class="col-md-1 profile_names d-none d-lg-block">
                <h4>ABDE ALI MOTIWALA</h4>
                <p>MOTIWALA & SONS</p>
            </div>
          
        </div>
    </div>
</section>

<section id="our_shops" style="background: #F6F4F2;">
    <div class="row align-items-center">
        <div class="col-md-6 p-0">
            <img class="w-100" src="{{ static_asset('assets/img/our_shop.webp') }}" />
        </div>
        <div class="col-md-6 p-0">
            <div class="text-center mb-md-0 mb-4 shop_box_content">
                    <h4 class="pt-4 text-uppercase">Our Shop</h4>
                    <p class="text-center">Motiwala Jewellery has been adorning dreams with precious simplicity for 100 years. Since 1923, our flagship store has stood as a testament to timeless craftsmanship, blending tradition and purity to create pieces that inspire elegance and curiosity.</p>
                    
                </div>
        </div>
    </div>
</section>

<section id="prduct_care" style="background: #F6F4F2;">
    <div class="row align-items-center">
         <div class="col-md-6 p-0 order-md-1 order-2">
            <div class="text-center mb-md-0 mb-4 shop_box_content">
                    <h4 class="pt-4 text-uppercase">Product Care</h4>
                    <p class="">Your jewelry deserves the utmost care to preserve its beauty and brilliance. Explore our expert guidance on storing, cleaning, and protecting your treasured pieces to ensure they remain as stunning as the day you fell in love with them.</p>
                
                </div>
        </div>
        <div class="col-md-6 p-0 order-md-2 order-1">
            <img class="w-100" src="{{ static_asset('assets/img/product_care.webp') }}" />
        </div>
       
    </div>
</section>

<section id="crafted_for_eternity" style="background: #F6F4F2;">
    <div class="row align-items-center">
        <div class="col-md-6 p-0">
            <img class="w-100" src="{{ static_asset('assets/img/crafted.webp') }}" />
        </div>
        <div class="col-md-6 p-0">
           <div class="text-center shop_box_content">
                    <h4 class="pt-4 text-uppercase">Crafted for eternity</h4>
                    <p class="">Every piece of Motiwala Jewellery is a testament to timeless elegance and masterful craftsmanship. Designed to endure and inspire, our creations are cherished heirlooms, crafted to be treasured for generations.</p>
                    
                </div>
        </div>
    </div>
</section>

<section class=" pt-4 pt-md-5 pb-md-5 pb-4">
    <div class="container">
           
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img class="" src="{{ static_asset('assets/img/free_shipping.svg') }}" />
                </div>
                <div class="text-center mb-md-0 mb-4">
                    <h4 class="fs-22 pt-3">Free Shipping</h4>
                    <p>Enjoy *free shipping* with no minimum purchase—because luxury should come hassle-free!</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="text-center">
                    <img class="" src="{{ static_asset('assets/img/100percent_icons.svg') }}" />
                </div>
                <div class="text-center mb-md-0 mb-4">
                    <h4 class="fs-22 pt-3">100% Certified Jewellery</h4>
                    <p>Our jewellery always comes with a certificate of authentication.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="text-center">
                    
                    <img class="" src="{{ static_asset('assets/img/premium_quality.svg') }}" />
                </div>
                <div class="text-center">
                    <h4 class="fs-22 pt-3">100% Secure Checkout</h4>
                    <p>Your peace of mind matters! We offer *100% secure checkout* with encrypted payment processing to keep your details safe. </p>
                </div>
            </div>


        </div>
    </div>
</section>


<section class="about_section pb-md-5">
    <div class="container">
    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="row">
                      <div class="col-md-4 p-md-2 p-0">
            <div class="mb-md-0 mb-3">
                <img class="w-100" src="{{ static_asset('assets/img/instagram_img1.webp') }}" />
            </div>
        </div>

        <div class="col-md-4 p-md-2 p-0">
            <div class="mb-md-0 mb-3">
                <img class="w-100" src="{{ static_asset('assets/img/instagram_img2.webp') }}" />
            </div>
        </div>

        <div class="col-md-4 p-md-2 p-0">
            <div class="mb-md-0 mb-3">
                <img class="w-100" src="{{ static_asset('assets/img/instagram_img3.webp') }}" />
            </div>
        </div>
            </div>
        </div>

        <div class="col-md-4 p-md-2 p-0">
            <div class="col-md-12 p-0">
            <div class="about_content_sec text-center">
                <h3 class="follow_heads text_clr_green">FOLLOW OUR INSTAGRAM</h3>
                
                <p class="about_content_para2 mb-0">Username: <b>motiwalajewelsofficial</b></p>
                <div class="shop_now_button2 text-white"><a target="_blank" href="https://www.instagram.com/motiwalajewelsofficial/">Follow More</a></div>
                
            </div>
        </div>
        </div>
          </div>
    </div>
</section>

@endsection
