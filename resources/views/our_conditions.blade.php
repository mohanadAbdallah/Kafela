<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Site made with Mobirise Website Builder v4.11.2, https://mobirise.com -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:image:src" content="assets/images/Home-meta.jpg"/>
    <meta property="og:image" content="assets/images/Home-meta.jpg"/>
    <meta name="twitter:title" content="Liven - لايفن"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link href="{{ asset('assets/images/liven-logo1-4-122x82.png')}}" rel="shortcut icon" type="image/x-icon"/>
    <meta name="description"
          content="برنامج رعاية رقمي مخصص لدعم الأشخاص المصابين بمرض السكري عن طريق تغيير نمط الحياة وتحقيق الأهداف الصحية">
    <meta name="keywords" content="Liven,السكري,لايفن,Coatching">
    <title>Liven - لايفن</title>
    <link href="{{ asset('assets/web/assets/mobirise-icons/mobirise-icons.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/bootstrap/css/bootstrap-grid.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/bootstrap/css/bootstrap-reboot.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/bootstrap/css/bootstrap-select.min.css')}}" rel="stylesheet"/>

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
        function initFreshChat() {
            window.fcWidget.init({
                token: "2cd8a901-92b7-45e4-b74b-c5a728c28a39",
                host: "https://wchat.freshchat.com"
            });
        }
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
            <div class="navbar-brand"><span class="navbar-logo"><img alt="Mobirise"
                                                                     src="{{ asset('assets/images/liven-logo1-4-122x82.png')}}"
                                                                     style="height: 3.8rem;" title=""/> </span></div>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-buttons mbr-section-btn"><a class="btn btn-sm btn-primary display-7"
                                                           href="{{route('front.home')}}">الصفحة الرئيسية</a></div>
        </div>
    </nav>
</section>


<section class="header4 cid-rAPHXlQta9" id="header4-j">
    <div class="container">
        <div class="row justify-content-md-center">

            <div class="media-content col-md-10 col-xs-12 col-sm-12 col-lg-10">

                <div class="card col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin: 0 auto;">
                    <div class="card-body " style="box-shadow: 0px 5px 10px -5px #6a306d;">
                        <div class="mbr-figure pt-0" id="container_field"><img alt="Mobirise"
                                                                               src="{{ asset('assets/images/liven-logo1-1368x921.png')}}"
                                                                               style="width: 50%;" title=""/></div>
                        {{--<h3 style="text-align: center">الشروط والاحكام</h3>--}}
                            {!! $conditions->conditions ?? '' !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="cid-rRm2QoVimE" id="social-buttons3-i">


    <center>
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row container d-flex justify-content-center">
                    <div class="col-md-8  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <div class="template-demo">

                                    @foreach($social_media as $item)
                                        <a target="_blank" href="{{$item->link}}"
                                           class="btn btn-social-icon  btn-rounded">
                                            <img width="50" height="50" style="border-radius: 3px"
                                                 src="{{Storage::url($item->image)}}" alt="{{$item->name}}">
                                        </a>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </center>
</section>
<section class="cid-rAPFyWML0m" id="footer6-g" once="footers">
    <div class="container">
        <div class="media-container-row align-center mbr-white">
            <div class="col-12">
                <p class="mbr-text mb-0 mbr-fonts-style display-7">&copy; Copyright 2020 Liven - All Rights Reserved</p>
            </div>
        </div>
    </div>
</section>
<style>
    .filter-option-inner-inner {
        text-align: right !important;
    }

    .dropdown-toggle {
        margin-right: 0px;
        margin-left: 0px;
        border: 1px solid #e8e8e8 !important;
        padding: 0.8rem 3rem !important;
        background-color: #f5f5f5 !important;
        outline: none !important;
        box-shadow: none;
    }

    .dropdown-toggle:focus {

        outline: none !important;
        box-shadow: none;
    }

    .dropdown-item.active, .dropdown-item:active {
        background-color: #6a306db3 !important;
    }
</style>
<script src="{{ asset('assets/web/assets/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/popper/popper.min.js')}}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap-select.min.js')}}"></script>
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
<script>
    $(document).ready(function () {

        $(document).on('keypress', '.phone_typing', function (e) {
//            var keyCode = (e.keyCode ? e.keyCode : e.which);

            if ((e.which === 32) || (e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123)) {
                return false;
            }
        });
        $(document).on('keypress', '.name_typing', function (e) {
            if (e.which >= 48 && e.which <= 57) {
                return false;
            }
        });

    });
</script>
</body>
</html>
