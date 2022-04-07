<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" id="csrf-token-public" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title class="title-home">{{ session()->get('app_name') }}</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icomoon/styles.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/minified/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/minified/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ar_css/bootstrap-rtl.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ar_css/ar.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ar_css/bootstrap-flipped.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custom-sheet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/minified/core.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/minified/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/minified/colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/easyTree.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" />

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/pickers/daterangepicker.js') }}"></script>

    {{--js for selectable + uploade imges + tags--}}
    <script type="text/javascript" src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pages/form_layouts.js') }}"></script>
    {{--js for selectable + uploade imges + tags--}}

    <script type="text/javascript" src="{{ asset('js/plugins/notifications/bootbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/notifications/sweet_alert.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/plugins/notifications/pnotify.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/plugins/velocity/velocity.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/velocity/velocity.ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/ui/prism.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/switch.min.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/switchery.min.js') }}"></script>--}}

       {{--<script type="text/javascript" src="{{ asset('js/pages/components_modals.js') }}"></script>--}}
    <script type="text/javascript" src="{{asset('js/plugins/xlsx.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/fileSaver.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/tableexport.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/liven.js?update=123456789')}}"></script>



    <script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>

</head>

<body>
<style>

</style>
<!-- Main navbar -->
<div class="navbar navbar-inverse" style="    background-color: #4CAF50  !important; border-color: #4CAF50  !important;">
    <div class="navbar-header">
        <a class="navbar-brand" style="    text-align: center;font-size: 14px;font-weight: bold;color: #e9f5ea;display: block;width: 100%;" href="{{route('home')}}">
            {{ session()->get('app_name') }}
        </a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse my-navbar-collapse" style="" id="navbar-mobile">
        <ul class="nav navbar-nav">
            @if(Auth::user()->role == 'admin')
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            @endif
        </ul>
        <ul class="nav navbar-nav navbar-right float-left margin-left-20 my-nav-bar" style="">




            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{  asset('images/default_user.png') }}" alt="">
                    <span>{{ Auth::user()->name }}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{route('profile.show')}}"><i class="icon-user-plus"></i>بياناتي</a></li>

                    <li>

                    <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        @if(Auth::user()->role == 'admin')
        <!-- Main sidebar -->
        <div class="sidebar sidebar-main" style="    background-color: #f2fff2 !important;border-left: 1px solid #eaeaea; color: #616161 !important;;">
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="category-content">
                        <div class="media">
                            <a href="#" class="media-left"><img src="{{  asset('images/default_user.png') }}" class="img-circle img-sm" alt=""></a>
                            <div class="media-body">
                                <span class="media-heading text-semibold">{{ Auth::user()->name }}</span>
                                <div class="text-size-mini text-muted" style="color: rgb(78, 78, 78) !important;">
                                </div>
                            </div>

                            <div class="media-right media-middle">
                                <ul class="icons-list">
                                    <li>
                                        <a href="{{route('profile.show')}}"><i class="icon-cog3"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->

                <style>
                    .navigation li a {
                        color: rgb(78, 78, 78) !important;
                    }
                    .navigation li a:hover, .navigation li a:focus {
                        background-color: rgba(0,0,0,0.1);
                        color: rgb(78, 78, 78) !important;
                    }
                    .navigation>li.active>a, .navigation>li.active>a:hover, .navigation>li.active>a:focus{
                        background-color: #dadada !important;
                    }
                    .navigation>li ul {
                        background-color: rgb(206, 255, 208) !important;
                    }
                    .navigation>li.active>a, .navigation>li.active>a:hover, .navigation>li.active>a:focus {
                        background-color: #b2f1b5 !important;
                    }
                    .navigation li a:hover, .navigation li a:focus {
                        background-color: rgb(178, 241, 181) !important;
                        color: rgb(78, 78, 78) !important;
                    }
                </style>
                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">

                            <!-- Main -->
                            <li><a href="{{route('home')}}" ><i style="    margin-right: 5px;" class="icon-stack2"></i><span>الصفحة الرئيسية</span></a></li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i style="" class="icon-stack2"></i> <span>الأخبار</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('post.index')}}" class="nav-link ">إدارة الاخبار</a></li>
                                    <li class="nav-item"><a href="{{route('post.create')}}" class="nav-link ">إضافة خبر جديد</a></li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i style="" class="icon-stack2"></i> <span>الأيتام</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('orphan.manage')}}" class="nav-link ">إدارة الايتام</a></li>
                                    <li class="nav-item"><a href="{{route('orphan.add')}}" class="nav-link ">إضافة يتيم جديد</a></li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-stack2"></i> <span>الكفلاء</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('sponsor.manage')}}" class="nav-link ">إدارة الكفلاء</a></li>
                                    <li class="nav-item"><a href="{{route('sponsor.add')}}" class="nav-link ">إضافة كافل جديد</a></li>
                                    <li class="nav-item"><a href="{{route('sponsor.pay')}}" class="nav-link ">تسجيل دفع الكفلاء</a></li>
                                    <li class="nav-item"><a href="{{route('orphan.sponsor.join')}}" class="nav-link ">إسناد كافل ليتيم</a></li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-stack2"></i> <span>التقارير</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('orphan.report')}}" class="nav-link ">تقرير الأيتام</a></li>
                                    <li class="nav-item"><a href="{{route('sponsor.report')}}" class="nav-link ">تقرير الكفلاء</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="{{route('settings')}}" class="nav-link" ><i style="    margin-right: 5px;" class="icon-stack2"></i><span>الاعدادات</span></a></li>
                            <li class="nav-item"><a href="{{route('messages')}}" class="nav-link" ><i style="    margin-right: 5px;" class="icon-stack2"></i><span>ارسال رسائل</span></a></li>



                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->
        @endif
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header">


                <div class="breadcrumb-line" style="background-color: #f2fff2;">
                    <ul class="breadcrumb">
                        <li><a href="/home"><i class="icon-home2 position-left"></i> الصفحة الرئيسية</a></li>
                        @if(isset($has_parent))
                            <li><a href="{{ $parent_url }}"> {{ $parent_name }}</a></li>
                        @endif
                        <li class="active">{{ $title }}</li>
                    </ul>


                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">
        <!-- Main content -->
    @yield('content')
        <div class="footer text-muted">
 جميع الحقوق محفوظة لدى {{ session()->get('app_name') }} 2020&copy;
        </div>
        <!-- /footer -->

    </div>
    <!-- /content area -->

</div>
    <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->
@yield('js_assets')
@yield('js_code')
</body>
</html>
