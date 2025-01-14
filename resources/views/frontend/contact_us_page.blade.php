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



<section class="breadcrums_sedction breacrums_bg">
    <div class="container">
    <!-- Breadcrumb -->
     <h4 class="text-white text-center">Contact Us</h4>
        <ul class="breadcrumb bg-transparent py-0 px-1 justify-content-center">
            <li class="breadcrumb-item fs-18">
                <a class="text-white" href="{{ route('home') }}">{{ translate('Home')}}</a>
            </li>
            <li class="fs-18 text-white fw-400 breadcrumb-item">
            <span>Contact Us</span>
            </li>
        </ul>
    </div>
</section>



<section class="" style="background:#DAD0C4;">
    @php
        $lang = str_replace('_', '-', app()->getLocale());
        $content = json_decode($page->getTranslation('content', $lang));
    @endphp
    <div class="">
        <div class="" style="background-color: {{ hex2rgba(get_setting('base_color', '#d43533'), 0.02) }}">
            <div class="row">
                


                <div class="col-lg-9">
                    <div class="p-3 p-md-4 p-xl-5">
                         <h1 class="fs40 mb-md-5 mb-4 text_clr_green ">{{ $page->getTranslation('title') }}</h1>
                        <!-- <p class="fs-16 fw-400 mb-5">{{ $content->description }}</p> -->
                        <div class="contact_form_box">
                            <div class="aboutbg_logo ">
                        <img src="http://127.0.0.1:8000/assets/img/about_logo_bg.svg">
                    </div>
                            <form class="form-default" role="form" action="{{ route('contact') }}" method="POST">
                                @csrf
                                

                                <div class="row">
                                    <div class="col-md-5">
                                         <div class="form-group mb-md-5 mb-4 pr-md-4">
                                            <label for="name" class="fs-20 fw-400 text_clr_green">{{  translate('Name') }}</label>
                                            <input type="text" class="form-control rounded-0" value="{{ old('name') }}" placeholder="{{  translate('Enter Name') }}" name="name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                         <div class="form-group mb-md-5 mb-4 pl-md-4">
                                            <label for="name" class="fs-20 fw-400 text_clr_green">{{  translate('Last Name') }}</label>
                                            <input type="text" class="form-control rounded-0" value="{{ old('name') }}" placeholder="{{  translate('Enter Name') }}" name="name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2"></div>

                                    <div class="col-md-5 ">
                                         <!-- Email -->
                                        <div class="form-group mb-md-5 mb-4 pr-md-4">
                                            <label for="email" class="fs-20 fw-400 text_clr_green">{{  translate('Email') }}</label>
                                            <input type="email" class="form-control rounded-0" value="{{ old('email') }}" placeholder="{{  translate('Enter Email') }}" name="email" required>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                         <!-- Phone -->
                                        <div class="form-group mb-md-5 mb-4 pl-md-4">
                                            <label for="phone" class="fs-20 fw-400 text_clr_green">{{  translate('Phone Number') }}</label>
                                            <input type="tel" class="form-control rounded-0" value="{{ old('phone') }}" placeholder="{{  translate('Enter Phone') }}" name="phone">
                                        </div>
                                    </div>

                                    <div class="col-md-2"></div>

                                    <div class="col-md-10">
                                          <div class="form-group">
                                    <label for="query" class="fs-20 fw-400 text_clr_green">{{  translate('Message') }}</label>
                                    <textarea
                                        class="form-control rounded-0"
                                        placeholder="{{translate('Type here...')}}"
                                        name="content"
                                        rows="5"
                                        required
                                    ></textarea>
                                </div>
                                    </div>

                                    <div class="col-md-2"></div>

                                    <div class="col-md-12">
                                        <!-- Submit Button -->
                                <div class="mt-md-4 mt-1 shop_now_button2">
                                    @if (env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
                                        <a class=""
                                            href="javascript:void(1)" onclick="showWarning()">
                                            {{  translate('Submit') }}
                                        </a>
                                    @else
                                        <button type="submit" class="btn btn-primary fw-700 fs-14 rounded-0 w-200px">{{  translate('Submit') }}</button>
                                    @endif

                                </div>
                                    </div>
                                </div>
                                <!-- Name -->
                               

                                 

                                
                               
                                <!-- Query -->
                               

                                <!-- Recaptcha -->
                                <!-- @if(get_setting('google_recaptcha') == 1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                    </div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                @endif -->

                                
                            </form>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-lg-3">
                   <div class="contact_image_box">
                    <img class="w-100" src="{{ static_asset('assets/img/contact_us_image.webp') }}"/>
                   </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="bg-white pt-5 pb-5">
    <div class="container">
        <div class="row">
                     <div class="col-lg-4 text-center">
                        <div class="mb-md-0 mb-4">
                            <span class="ml-3">
                                <img class="w100 mb-md-4 mb-2" src="{{ static_asset('assets/img/call_icons.svg') }}"/>
                                <!-- <span class="fs-19 fw-700">{{ translate('Phone') }}</span><br> -->
                                <span class="fs-24 text_clr_green d-block">{{ $content->phone }}</span>
                            </span>
                        </div>
                     </div>

                     <div class="col-lg-4 text-center">
                        <div class="mb-md-0 mb-4">
                            <span class="ml-3">
                                <img class="w100 mb-md-4 mb-2" src="{{ static_asset('assets/img/adress_icons.svg') }}"/>
                                <!-- <span class="fs-19 fw-700">{{ translate('Phone') }}</span><br> -->
                                <span class="fs-24 text_clr_green d-block">{!! str_replace("\n", "<br>", $content->address) !!}</span>
                            </span>
                        </div>
                     </div>

                     <div class="col-lg-4 text-center">
                        <div class="">
                            <span class="ml-3">
                                <img class="w100 mb-md-4 mb-2" src="{{ static_asset('assets/img/envelope_icon.svg') }}"/>
                                <!-- <span class="fs-19 fw-700">{{ translate('Phone') }}</span><br> -->
                                <span class="fs-24 text_clr_green d-block">{{ $content->email }}</span>
                            </span>
                        </div>
                     </div>
        </div>
    </div>
</section>



@endsection

@section('script')
    @if(get_setting('google_recaptcha') == 1)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
    
    <script type="text/javascript">
        @if(get_setting('google_recaptcha') == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are human!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });
        @endif
    </script>


    <script type="text/javascript">
        function showWarning(){
            AIZ.plugins.notify('warning', "{{ translate('Something went wrong.') }}");
            return false;
        }
    </script>
@endsection
