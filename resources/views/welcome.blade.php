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
                                                           href="#contacts1-1a">اتصل بنا</a></div>
            <div class="navbar-buttons mbr-section-btn"><a class="btn btn-sm btn-primary display-7"
                                                           href="{{route('login.patient.show')}}">دخول</a></div>
            {{--<div class="navbar-buttons mbr-section-btn"></div>--}}

        </div>
    </nav>
</section>


<section class="header4 cid-rAPHXlQta9" id="header4-j">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="media-content col-md-10">
                <h1 class="mbr-section-title align-center mbr-white pb-3 mbr-bold mbr-fonts-style display-1">لايفن</h1>

                <div class="mbr-text align-center mbr-white pb-3">
                    <p class="mbr-text mbr-fonts-style display-4">برنامج رعاية رقمي مخصص لدعم الأشخاص المصابين بمرض
                        السكري عن طريق تغيير نمط الحياة وتحقيق الأهداف الصحية</p>
                </div>

                <div class="mbr-section-btn align-center">
                    <a class="btn btn-md btn-primary display-5" style=""
                       href="{{route('front.submit.patient')}}">تسجيل مصاب بمرض السكري</a>
                    <a class="btn btn-md btn-primary display-5" style=""
                       href="{{route('front.submit.dietitian')}}">تسجيل أخصائي تغذية علاجية</a>
                </div>

            </div>

            <div class="mbr-figure"><img alt="Mobirise" src="{{ asset('assets/images/liven-logo1-1368x921.png')}}"
                                         style="width: 60%;" title=""/></div>
                <div class="media-content col-md-10">
                    <div class="mbr-text align-center mbr-white pb-3">
                        <p class="mbr-text mbr-fonts-style display-4">قم بتحميل التطبيق وسجل برقم الجوال </p>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-2 col-8 mb-3"></div>
                <div class="col-md-3 col-sm-3 col-xs-2 col-8 " style="margin: 0 auto;padding-bottom: 10px">
                    <a href="#">
                        <img class="img-fluid"
                             src="{{asset('images/apple_store.png')}}" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-2 col-xs-2 col-8" style="margin: 0 auto;">
                    <div class="thumbnail">
                        <a href="#">
                            <img class="img-fluid"
                                 src="{{asset('images/google_play.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-2 col-xs-2 col-8 mb-3"></div>
            </div>
        </div>
    </div>
</section>

<section class="header12 cid-rAQepgyC9k mbr-fullscreen mbr-parallax-background" id="header12-k">


    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(0, 0, 0);">
    </div>

    <div class="container  ">
        <div class="media-container">
            <div class="col-md-12 align-center">
                <h1 class="mbr-section-title pb-3 mbr-white mbr-bold mbr-fonts-style display-1">إكتسب عادات صحية
                    دائمة</h1>
                <p class="mbr-text pb-3 mbr-white mbr-fonts-style display-5">نحن نحيطك بالأدوات والدعم الذي تحتاجه
                    لتغيير نمط حياتك والمحافظة على صحتك<br></p>


                <div class="icons-media-container mbr-white">
                    <div class="card col-12 col-md-6 col-lg-4">
                        <div class="icon-block">

                            <span class="mbr-iconfont mbri-users"></span>

                        </div>
                        <h5 class="mbr-fonts-style display-5">يساعدك الأخصائي في التغلب على العقبات</h5>
                    </div>

                    <div class="card col-12 col-md-6 col-lg-4">
                        <div class="icon-block">

                            <span class="mbr-iconfont mbri-devices"></span>

                        </div>
                        <h5 class="mbr-fonts-style display-5">التقنية تساهم في تتبع مؤشراتك الصحية لتكتشف وتحسن عاداتك
                            اليومية</h5>
                    </div>

                    <div class="card col-12 col-md-6 col-lg-4">
                        <div class="icon-block">

                            <span class="mbr-iconfont mbri-bulleted-list"></span>

                        </div>
                        <h5 class="mbr-fonts-style display-5">قائمة مهام مخصصة تساعدك للوصول إلى أهدافك الصحية
                        </h5>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next">
            <i class="mbri-down mbr-iconfont"></i>
        </a>
    </div>
</section>

<section class="timeline2 cid-rBFLHE4nNN" id="timeline2-16" dir="rtl">
    <div class="container align-center">
        <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2">برنامج لايفن الخاص</h2>

        <h3 class="mbr-section-subtitle pb-2 mbr-fonts-style display-5">&nbsp;تبدأ رحلتك معنا بالتسجيل وسيقوم فريقنا
            بالتواصل معك </h3>
        <a class="btn btn-sm btn-primary display-7 mb-5" href="{{route('front.submit')}}">التسجيل</a>
        <div class="container timelines-container" mbri-timelines=""><!--1-->
            <div class="row timeline-element reverse separline">
                <div class="col-xs-12 col-md-6 align-left">
                    <div class="timeline-text-content">
                        <h5 class="mbr-timeline-title pb-3 mbr-fonts-style display-5"><strong>بعد الإشتراك </strong>
                        </h5>

                        <p class="mbr-timeline-text mbr-fonts-style display-7">تسجل دخولك على تطبيق <strong>
                                Liven SA</strong>
                            <br/>
                            <br/>
                            <em> ويتم توصيل جهاز متابعة مستوى السكر بالدم المستمر إلى بيتك</em>
                        </p>
                    </div>
                </div>
            </div>
            <!--2-->

            <div class="row timeline-element  separline">
                <div class="col-xs-12 col-md-6 align-left ">
                    <div class="timeline-text-content">
                        <h5 class="mbr-timeline-title pb-3 mbr-fonts-style display-5"><strong>بناء البرنامج</strong>
                        </h5>

                        <p class="mbr-timeline-text mbr-fonts-style display-7">تحديد خطتك والعمل مع الأخصائي الخاص بك&nbsp;لمدة
                            شهر </p>
                    </div>
                </div>
            </div>
            <!--3-->

            <div class="row timeline-element reverse separline">
                <div class="col-xs-12 col-md-6 align-left">
                    <div class="timeline-text-content">
                        <h5 class="mbr-timeline-title pb-3 mbr-fonts-style display-5"><strong>بداية البرنامج</strong>
                        </h5>

                        <p class="mbr-timeline-text mbr-fonts-style display-7">سيقوم الأخصائي بمتابعة مؤشراتك وعاداتك
                            اليومية</p>
                    </div>
                </div>
            </div>
            <!--4-->

            <div class="row timeline-element  separline">
                <div class="col-xs-12 col-md-6 align-left ">
                    <div class="timeline-text-content">
                        <h5 class="mbr-timeline-title pb-3 mbr-fonts-style display-5"><strong>المتابعة
                                الأسبوعية</strong></h5>

                        <p class="mbr-timeline-text mbr-fonts-style display-7">سيقوم الأخصائي بعمل التعديلات على
                            البرنامج بناءً على القراءات والمعطيات الأسبوعية والتحدث معك</p>
                    </div>
                </div>
            </div>
            <!--5-->

            <div class="row timeline-element reverse">
                <div class="col-xs-12 col-md-6 align-left">
                    <div class="timeline-text-content">
                        <h5 class="mbr-timeline-title pb-3 mbr-fonts-style display-5"><strong>المتابعة اليومية</strong>
                        </h5>

                        <p class="mbr-timeline-text mbr-fonts-style display-7">يقوم الأخصائي بمساعدتك على الحفاظ علي
                            روتينك الجديد وتقديم الدعم والتواصل الدائم</p>
                    </div>
                </div>
            </div>
            <!--6--><!--7--><!--8--><!--9--><!--10--><!--11--><!--12--></div>
    </div>
</section>

<section class="clients cid-rFswwABqXh" data-interval="false" id="clients-1c">
    <div class="container mb-5">
        <div class="media-container-row">
            <div class="col-12 align-center">
                <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2">شركاء النجاح</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="carousel slide" data-interval="5000" data-keyboard="false" data-pause="true" data-ride="carousel"
             role="listbox">
            <div class="carousel-inner" data-visible="4">
                @foreach($partners as $partner)
                    <div class="carousel-item ">
                        <div class="media-container-row">
                            <div class="col-md-12">
                                <div class="wrap-img ">
                                    <a target="_blank" href="{{$partner->website}}">
                                        <img alt="{{ $partner->name }}" class="img-responsive clients-img"
                                             src="{{Storage::url($partner->image)}}" title="{{ $partner->name }}"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="carousel-controls"><a class="carousel-control carousel-control-prev"
                                              data-app-prevent-settings="" data-slide="prev" role="button"> <span
                            class="sr-only">Previous</span> </a> <a class="carousel-control carousel-control-next"
                                                                    data-app-prevent-settings="" data-slide="next"
                                                                    role="button"> <span class="sr-only">Next</span>
                </a></div>
        </div>
    </div>
</section>

<section class="mbr-section contacts1 cid-rFsupmCiDU" id="contacts1-1a"><!--Overlay--><!--Container-->
    <div class="container">
        <div class="row" dir="rtl"><!--Titles-->
            <div class="title col-12">
                <h2 class="align-right mbr-fonts-style display-1">إتصل بنا</h2>
            </div>
            <!--Left-->

            <div class="col-12 col-md-6">
                <div class="left-block wrapper">
                    <div class="b b-adress">
                        <h5 class="align-right mbr-fonts-style m-0 display-5">العنوان</h5>

                        <p class="mbr-text align-right mbr-fonts-style display-7">{{$contact->address ?? ''}}</p>
                    </div>

                    <div class="b b-phone">
                        <h5 class="align-right mbr-fonts-style m-0 display-5">رقم التواصل</h5>

                        <p class="mbr-text align-right mbr-fonts-style display-7">{{$contact->phone ?? ''}}</p>
                    </div>

                    <div class="b b-mail">
                        <h5 class="align-right mbr-fonts-style m-0 display-5">البريد الإلكتروني</h5>

                        <p class="mbr-text align-right mbr-fonts-style display-7">{{$contact->email ?? ''}}</p>
                    </div>
                </div>
            </div>
            <!--Right-->

            <div class="col-12 col-md-6">
                <div class="google-map">
                    <iframe allowfullscreen="" frameborder="0"
                            src="https://maps.google.com/maps?q={{$contact->latitude ?? ''}},{{$contact->longitude ?? ''}}&hl=es&z=14&amp;output=embed"

                            style="border:0"></iframe>
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
