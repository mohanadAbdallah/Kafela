@extends('layouts.main',['title' => '' , 'js'=>'home'])
@section('content')
    <style>
        .custom-td-show .labels {
            color: #4CAF50 !important;
        }
    </style>
    <!-- Main charts -->
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>

                <div class="heading-elements">

                    <span class="heading-text">الصفحة الرئيسية</span>

                </div>
            </div>

            <div class="panel-body" style="text-align: center">
                <h2>مرحبا بكم في موقع</h2>
                <h1 style="    font-size: 3em;font-weight: bold;color: #4caf50;">{{ session()->get('app_name') }}</h1>
               @if(session()->get('app_logo') != '') <img width="100" style="border-radius: 10px" src="{{ env('APP_URL').'/public/storage/'.session('app_logo') }}" alt=""> @endif


            </div>
            <div class="card">
                <div class="card-header header-elements-inline">

                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>

                        </div>
                    </div>
                </div>


            <div class="row">
                <!-- Column -->
                <div class="col-sm-12 col-md-6">
                    <div class="card bg-info">
                        <div class="card-body text-white">
                            <div class="d-flex flex-row">
                                <div class="align-self-center display-6"><i class="ti-wallet"></i></div>
                                <div class="p-20 align-self-center">
                                    <h4 class="m-b-0">الكفلاء</h4>
                                    <span>عدد جميع الكفلاء المضافين</span>
                                    <span style="font-size: x-large;float: left;" class="font-medium m-b-0">{{ $count_sponsors ?? 0 }}</span>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-sm-12 col-md-6">
                    <div class="card bg-success">
                        <div class="card-body text-white">
                            <div class="d-flex flex-row">
                                <div class="display-6 align-self-center"><i class="ti-user"></i></div>
                                <div class="p-20 align-self-center">
                                    <h4 class="m-b-0">الكفلاء</h4>
                                    <span>عدد الكفلاء المسندين لايتام</span>
                                    <span style="font-size: x-large;float: left;" class="font-medium m-b-0">{{ $has_orphans ?? 0 }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-sm-12 col-md-6" style="margin: 10px 0px;">
                    <div class="card bg-danger">
                        <div class="card-body text-white">
                            <div class="d-flex flex-row">
                                <div class="display-6 align-self-center"><i class="ti-calendar"></i></div>
                                <div class="p-20 align-self-center">
                                    <h4 class="m-b-0">الأيتام</h4>
                                    <span>عدد جميع الايتام المضافين</span>
                                    <span style="font-size: x-large;float: left;" class="font-medium m-b-0">{{ $count_orphans ?? 0 }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-sm-12 col-md-6" style="margin: 10px 0px;">
                    <div class="card bg-orange">
                        <div class="card-body text-white">
                            <div class="d-flex flex-row">
                                <div class="display-6 align-self-center"><i class="ti-settings"></i></div>
                                <div class="p-20 align-self-center">
                                    <h4 class="m-b-0" >الأيتام</h4>
                                    <span >عدد جميع الايتام المسندين بكفلاء</span>
                                    <span style="font-size: x-large;float: left;" class="font-medium m-b-0">{{ $has_sponsors ?? 0 }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>


            <div class="table-responsive">

                <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                    <thead>
                    <tr>
                        <th>ادخل كلمة البحث</th>
                        <th><input type="text" class="form-control search_table" placeholder="البحث السريع"></th>
                        <th colspan="2">
                            <a href="#" route="{{route('send.message.manually')}}" class="send_message_manually_btn btn bg-green-400 btn-labeled new-center-btn"
                               style="float:left;">
                                <b><i class=" icon-envelop2 icon-loader"></i>
                                    <i class="icon-spinner2 spinner position-left hide loader"
                                       style="margin-top: 3px;float: left;"></i>
                                </b> ارسال رسائل للمتأخرين

                            </a>
                        </th>
                        <th colspan="2"></th>
                        <th>عدد المتأخرين ({{count($users)}})</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;    background: #f2fff2;" colspan="7">جدول الكفلاء المتاخرين في الدفع</th>
                    </tr>
                    <tr>
                        <th>رقم ملف الكافل</th>
                        <th>الاسم</th>
                        <th>رقم الجوال</th>
                        <th>نوع الكفالة</th>
                        <th>تاريخ انتهاء الدفع</th>
                        <th>قيمة الدفع</th>
                        <th>عرض</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $item)
                        <tr class="search-in">
                            <td class="sponsor_file_no">{{ $item->sponsor_file_no }}</td>
                            <td class="name">{{ $item->name }}</td>
                            <td class="phone">{{ $item->phone }}</td>
                            <td class="ensure_type">{{ $item->ensure_type_text }}</td>
                            <td >{{ $item->sponsor_pay_end }}</td>
                            <td >{{ $item->sponsor_pay_value }}</td>
                            <td class="text-center">

                                <a href="#" class="show-sponsor-btn" RowId="{{$item->id}}">
                                    <i class="  icon-grid info-icon"></i>
                                </a>
                                <input type="hidden" name="orphan" class="orphan" value="{{$item->id}}"/>

                            </td>
                        </tr>
                        @foreach($item->orphans as $orphan)
                            @if($loop->index == 0)
                                <tr class="hide-td details-rows show_{{$item->id}}">
                                    <td colspan="2" class="custom-td-show"
                                        style="font-weight:bold;padding: 10px;    background: #efefef;">رقم ملف اليتيم
                                    </td>
                                    <td colspan="2" class="custom-td-show"
                                        style="font-weight:bold;padding: 10px;    background: #efefef;">الاسم
                                    </td>
                                    <td class="custom-td-show"
                                        style="font-weight:bold;padding: 10px;    background: #efefef;">إسم الوالي
                                    </td>
                                    <td colspan="2"  class="custom-td-show"
                                        style="font-weight:bold;padding: 10px;    background: #efefef;">رقم الجوال
                                    </td>
                                </tr>
                            @endif
                            <tr class="hide-td details-rows show_{{$item->id}}">
                                <td colspan="2" class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">{{$orphan->orphan_file_no}}</td>
                                <td colspan="2" class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">{{$orphan->name}}</td>
                                <td class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">{{$orphan->mother_name}}</td>
                                <td colspan="2" class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">{{$orphan->mother_phone}}</td>
                            </tr>
                        @endforeach
                        @if(count($item->orphans) == 0 )
                            <tr class="hide-td details-rows show_{{$item->id}}">
                                <td colspan="7" class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">لا يوجد أيتام مكفولين
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @if(count($users) == 0)
                        <tr class=" ">
                            <td colspan="7"
                                style="padding: 10px;    background: #fbfbfb;text-align: center">لا يوجد كفلاء متأخرين
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
    <style>
        .end_date_danger {
            background-color: #FF5722;
            font-size: larger;
            font-weight: bold;
            color: white;
            padding: 0px 10px;
            border-radius: 5px;
        }

        .end_date_warning {
            background-color: #FFC107;
            font-size: larger;
            font-weight: bold;
            color: white;
            padding: 0px 10px;
            border-radius: 5px;
        }
    </style>

@endsection

@section('js_code')
    <script src="{{asset('js/plugins/visualization/echarts/echarts.js')}}"></script>

    <script src="{{asset('js/demo_charts/echarts/light/pies/pie_basic.js')}}"></script>
    <script src="{{asset('js/demo_charts/echarts/light/pies/pie_donut.js')}}"></script>
    <script src="{{asset('js/demo_charts/echarts/light/pies/pie_nested.js')}}"></script>
    <script src="{{asset('js/demo_charts/echarts/light/pies/pie_rose.js')}}"></script>
    <script src="{{asset('js/demo_charts/echarts/light/pies/pie_rose_labels.js')}}"></script>
    <script src="{{asset('js/demo_charts/echarts/light/pies/pie_levels.js')}}"></script>
    <script src="{{asset('js/demo_charts/echarts/light/pies/pie_timeline.js')}}"></script>
    <script src="{{asset('js/demo_charts/echarts/light/pies/pie_multiple.js')}}"></script>
    <script src="{{asset('js/plugins/visualization/d3/d3.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(".search_table").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#requests-table tr.search-in").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection