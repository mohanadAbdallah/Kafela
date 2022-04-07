<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Site made with Mobirise Website Builder v4.11.2, https://mobirise.com -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:image:src" content="assets/images/Home-meta.jpg"/>
    <meta property="og:image" content="assets/images/Home-meta.jpg"/>
    <meta name="twitter:title" content="{{ session()->get('app_name') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

    <title>{{ session()->get('app_name') }}</title>
    <link href="{{ asset('assets/web/assets/mobirise-icons/mobirise-icons.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/bootstrap/css/bootstrap-grid.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/bootstrap/css/bootstrap-reboot.min.css')}}" rel="stylesheet"/>

    <link href="{{ asset('assets/tether/tether.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/dropdown/css/style.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/theme/css/style.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/fonts/style.css')}}" rel="stylesheet"/>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/icons_social.css')}}">
    <link href="{{ asset('assets/mobirise/css/mbr-additional.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q6TMV9E80K"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-Q6TMV9E80K');
    </script>
    <script>

        function initialize(i, t) {
            var e;
            i.getElementById(t) ? initFreshChat() : ((e = i.createElement("script")).id = t, e.async = !0, e.src = "https://wchat.freshchat.com/js/widget.js", e.onload = initFreshChat, i.head.appendChild(e))
        }
        function initiateCall() {
            initialize(document, "freshchat-js-sdk")
        }
        window.addEventListener ? window.addEventListener("load", initiateCall, !1) : window.attachEvent("load", initiateCall, !1);
    </script>
</head>

<body>
<section class="menu cid-rBv77AIps1" id="menu2-11" once="menu">
    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                class="navbar-toggler navbar-toggler-right" data-target="#navbarSupportedContent" data-toggle="collapse"
                type="button"></button>
        <div class="hamburger"></div>

        <div class="menu-logo">
            <div class="navbar-brand"><span class="navbar-logo"></span></div>
        </div>

    </nav>
</section>


<section class="header4 cid-rAPHXlQta9" id="header4-j">
    <div class="container">
        <div class="row justify-content-md-center">

            <div class="card col-md-8 col-sm-10 col-xs-10 col-lg-8" style="margin: 0 auto;">
                <div class="card-body " style="box-shadow: 0px 5px 10px -5px #4caf50;">
                    <div class="card-body ">
                        <div class="mbr-figure pt-0">
                            @if(isset($register)) <h4 style="font-family: 'Changa-Regular';color: #00BCD4;font-weight: bold;margin-bottom: 30px;margin-top: 30px;
">تم تفعيل الاشتراك بنجاح</h4> @endif
                        </div>
                        <div class="mbr-figure pt-0">

                            @if(!isset($fail)) <h2 style="font-size: 2em;font-family: 'Changa-Regular';color: #4caf50;font-weight: bold;margin-bottom: 30px;margin-top: 30px;
"> أهلا بكم في {{ session()->get('app_name') }}</h2> @endif


                        </div>
                        <div class="mbr-figure pt-0">

                            @if(session()->get('app_logo') != '') <img alt="شعار" src="{{ env('APP_URL').'/public/storage/'.session('app_logo') }}"
                                                                       style="width: 30%;" title=""/>   @endif


                        </div>
                        @if(!isset($fail))

                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                {{ csrf_field() }}

                                @php
                                    $input_text = 'رقم الجوال';
                                        $input_type = 'phone';
                                @endphp

                                <div class="form-group display-7" style="text-align: right" dir="rtl">
                                    <label for="exampleFormControlInput1">{{$input_text}}</label>
                                    <input type="{{$input_type}}"
                                           class="form-control  @error('{{$input_type}}') is-invalid @enderror"
                                           name="{{$input_type}}" value="{{ old($input_type) }}" required
                                           autocomplete="{{$input_type}}" autofocus id="exampleFormControlInput1"
                                           placeholder="{{$input_text}}">
                                    @error('{{$input_type}}')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group display-7" style="text-align: right" dir="rtl">
                                    <label for="exampleFormControlInput1">كلمة السر</label>
                                    <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password"
                                           id="exampleFormControlInput1"
                                           placeholder="كلمة السر">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group display-7" style="text-align: right" dir="rtl">
                                    <label for="" style="font-size: 14px;"><a href="{{route('forget.password')}}">نسيت كلمة المرور</a></label>
                                    <label for="" style="display:block;font-size: 14px;"><a href="{{route('register.sponsor')}}">تسجيل كافل جديد</a></label>

                                </div>





                                <div class="form-group display-7" style="text-align: center">

                                    <button type="submit"
                                            style="    background-color: #4CAF50  !important;border:#4CAF50  "
                                            class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="mbr-figure pt-0">
                                <h4 style="font-family: 'Changa-Regular';color: #ff6851;font-weight: bold;margin-bottom: 30px;margin-top: 30px;
}">
                                    {{ $fail }}
                                </h4>

                            </div>

                        @endif

                    </div>
                </div>


            </div>
        </div>
    </div>
    <style>
        .form-control.focus {
            box-shadow: 0 0 0 0.2rem rgba(46, 195, 19, 0.25) !important;
        }
    </style>
</section>

<section class="cid-rAPFyWML0m" id="footer6-g" once="footers">
    <div class="container">
        <div class="media-container-row align-center mbr-white">
            <div class="col-12">
                <p class="mbr-text mb-0 mbr-fonts-style display-7"> جميع الحقوق محفوظة
                    لدى {{ session()->get('app_name') }} 2020&copy;</p>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('assets/web/assets/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/popper/popper.min.js')}}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/tether/tether.min.js')}}"></script>
<script src="{{ asset('assets/smoothscroll/smooth-scroll.js')}}"></script>
<script src="{{ asset('assets/parallax/jarallax.min.js')}}"></script>
<script src="{{ asset('assets/bootstrapcarouselswipe/bootstrap-carousel-swipe.js')}}"></script>
<script src="{{ asset('assets/mbr-clients-slider/mbr-clients-slider.js')}}"></script>
<script src="{{ asset('assets/dropdown/js/nav-dropdown.js')}}"></script>
<script src="{{ asset('assets/dropdown/js/navbar-dropdown.js')}}"></script>
<script src="{{ asset('assets/touchswipe/jquery.touch-swipe.min.js')}}"></script>
<script src="{{ asset('assets/vimeoplayer/jquery.mb.vimeo_player.js')}}"></script>
<script src="{{ asset('assets/theme/js/script.js')}}"></script>
</body>
</html>
