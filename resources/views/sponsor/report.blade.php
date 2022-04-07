@extends('layouts.main',['title' => 'تقرير الكفلاء' , 'js'=>'liven'])

@section('content')
    {{--for validation errors--}}
    <validation class="validation hide">
        <error class="validation-error">
            <div class="form-control-feedback">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block">Error input</span>
        </error>
    </validation>
    {{--for validation errors--}}

    <div class="panel-body">
        <form action="" method="get" class="form-horizontal"
              style="    background: white;padding: 3px;border-radius: 0px;border: 1px solid #eaeaea;">
            <h5 style="    padding: 10px;">بحث</h5>
            <div class="form-group">
                <div class="form-group col-md-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping">الاسم</span>
                    </div>
                    <input type="text" class="form-control" name="name" value="{{request()->get('name')}}"
                           aria-describedby="addon-wrapping">
                </div>
                <div class="form-group col-md-3">
                    <button class="btn btn-success" style="margin: 19px 0px;" type="submit">
                        بحث
                    </button>
                    <button class="btn btn-info mr-1" style="  margin: 19px 3px;" type="button"
                            data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">
                        متقدم
                    </button>
                    <button class="btn btn-warning mr-1 print_excel "
                            style="float: left;margin: 19px 0px" type="button">
                        تصدير اكسل

                    </button>
                </div>
                <div class="collapse w-100 col-md-12" id="collapseExample">
                    <div class="card card-body">

                        <div class="form-group">
                            <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                <label class="col-lg-3 ">
                                    <span class="labels">الحالة: </span>
                                    <select name="ensure_state" class="form-control" id="ensure_state">
                                        <option value="">اختر</option>
                                        <option value="has_orphan" {{request()->get('ensure_state') =='has_orphan' ? 'selected':''}}>
                                            مستخدمين مسند لهم أيتام
                                        </option>
                                        <option value="has_not_orphan" {{request()->get('ensure_state') =='has_not_orphan' ? 'selected':''}}>
                                            مستخدمين لم يسند لهم
                                        </option>
                                        <option value="1" {{request()->get('ensure_state') =='1' ? 'selected':''}}>
                                            مستخدمين مسند لهم يتيم واحد
                                        </option>
                                        <option value="2" {{request()->get('ensure_state') =='2' ? 'selected':''}}>
                                            مستخدمين مسند لهم يتيمين اثنين
                                        </option>
                                        <option value="3" {{request()->get('ensure_state') =='3' ? 'selected':''}}>
                                            مستخدمين مسند لهم لهم ثلاث ايتام
                                        </option>
                                        <option value="more_than_3" {{request()->get('ensure_state') =='more_than_3' ? 'selected':''}}>
                                            مستخدمين مسند لهم أكثر من 3 ايتام
                                        </option>
                                    </select>
                                </label>
                                <label class="col-lg-3 ">
                                    <span class="labels">نوع الكفالة: </span>
                                    <select name="ensure_type" id="ensure_type" class="form-control ensure_type">
                                        <option value="" {{ request()->get('ensure_type') == '' ? 'selected' : '' }} >اختر</option>
                                        <option value="1" {{ request()->get('ensure_type') == 1 ? 'selected' : '' }} >شهري</option>
                                        <option value="2"  {{ request()->get('ensure_type') == 2 ? 'selected' : '' }}>سنة واحدة</option>
                                        <option value="15"  {{ request()->get('ensure_type') == 15 ? 'selected' : '' }}>سنتين</option>
                                        <option value="16"  {{ request()->get('ensure_type') == 16 ? 'selected' : '' }}>ثلاث سنوات</option>
                                        <option value="3" {{ request()->get('ensure_type') == 3 ? 'selected' : '' }}>مقدم لعدد 1 شهر</option>
                                        <option value="4" {{ request()->get('ensure_type') == 4 ? 'selected' : '' }}>مقدم لعدد 2 شهر</option>
                                        <option value="5" {{ request()->get('ensure_type') == 5 ? 'selected' : '' }}>مقدم لعدد 3 شهر</option>
                                        <option value="6" {{ request()->get('ensure_type') == 6 ? 'selected' : '' }}>مقدم لعدد 4 شهر</option>
                                        <option value="7" {{ request()->get('ensure_type') == 7 ? 'selected' : '' }}>مقدم لعدد 5 شهر</option>
                                        <option value="8" {{ request()->get('ensure_type') == 8 ? 'selected' : '' }}>مقدم لعدد 6 شهر</option>
                                        <option value="9" {{ request()->get('ensure_type') == 9 ? 'selected' : '' }}>مقدم لعدد 7 شهر</option>
                                        <option value="10" {{ request()->get('ensure_type') == 10 ? 'selected' : '' }}>مقدم لعدد 8 شهر</option>
                                        <option value="11" {{ request()->get('ensure_type') == 11 ? 'selected' : '' }}>مقدم لعدد 9 شهر</option>
                                        <option value="12" {{ request()->get('ensure_type') == 12 ? 'selected' : '' }}>مقدم لعدد 10 شهر</option>
                                        <option value="13" {{ request()->get('ensure_type') == 13 ? 'selected' : '' }}>مقدم لعدد 11 شهر</option>
                                        <option value="14" {{ request()->get('ensure_type') == 14 ? 'selected' : '' }}>مقدم لعدد 12 شهر</option>
                                    </select>
                                </label>
                                <label class="col-lg-3 ">
                                    <span class="labels">الدفع المتأخر: </span>
                                    <select name="sponsor_not_pay" id="sponsor_not_pay" class="form-control sponsor_not_pay">
                                        <option value="" {{ request()->get('sponsor_not_pay') == '' ? 'selected' : '' }} >اختر</option>
                                        <option value="30" {{ request()->get('sponsor_not_pay') == 30 ? 'selected' : '' }} >مستخدمين لم يدفعون خلال 30 يوم</option>
                                        <option value="60" {{ request()->get('sponsor_not_pay') == 60 ? 'selected' : '' }}>مستخدمين لم يدفعون خلال 60 يوم</option>
                                        <option value="90" {{ request()->get('sponsor_not_pay') == 90 ? 'selected' : '' }}>مستخدمين لم يدفعون خلال 90 يوم</option>
                                    </select>
                                </label>
                                <label class="col-lg-3 ">
                                    <span class="labels">رقم ملف الكافل: </span>
                                    <input type="text" name="sponsor_file_no" class="form-control"
                                           value="{{request()->get('sponsor_file_no')}}">
                                </label>
                                <label class="col-lg-3 ">
                                    <span class="labels">جوال: </span>
                                    <input type="text" name="phone" class="form-control"
                                           value="{{request()->get('phone')}}">
                                </label>


                            </div>


                            <style>
                                .bootstrap-tagsinput input {
                                    line-height: 35px;
                                }
                            </style>


                        </div>
                    </div>

                </div>


            </div>
        </form>
    </div>
    <!-- Main charts -->
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>


                <div class="heading-elements">

                    <span class="heading-text">تقرير الايتام</span>

                </div>
            </div>


            <div class="table-responsive">
                <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                    <thead>
                    <tr>
                        <th>ادخل كلمة البحث</th>
                        <th><input type="text" class="form-control search_table" placeholder="البحث"></th>
                        <th colspan="5"></th>
                    </tr>
                    <tr>
                        <th>عدد الايتام المكفولين</th>
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
                            <td class="sponsor_file_no11"><a href="#" class="show-sponsor-btn" RowId="{{$item->id}}">{{ count($item->orphans) }}</a></td>
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
                                    <td  class="custom-td-show"
                                        style="font-weight:bold;padding: 10px;    background: #efefef;">حذف
                                    </td>
                                    <td  class="custom-td-show"
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
                                <td class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">
                                    <a href="#" class="delete-orphan-sponsor-btn"
                                       route="{{route('sponsor.orphan.delete',['sponsor'=>$item->id,'orphan'=>$orphan->id])}}" style="margin: 0px 3px;">
                                        <i class="  icon-cancel-square delete-icon"
                                           style=" color: #d84315;font-size: 18px;"></i>
                                    </a>
                                </td>
                                <td  class="custom-td-show"
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
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <table class="table datatable-basic table-bordered dataTable no-footer" style="display: none" id="requestsTable">
        <thead>
        <tr>
            <th>رقم ملف الكافل</th>
            <th>الاسم</th>
            <th>الجوال</th>
            <th>نوع الكفالة</th>
            <th>تاريخ انتهاء الدفع</th>
            <th>قيمة الدفع</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $item)
            <tr >
                <td class="sponsor_file_no">{{ $item->sponsor_file_no }}</td>
                <td class="name">{{ $item->name }}</td>
                <td class="phone">{{ $item->phone }}</td>
                <td class="ensure_type">{{ $item->ensure_type_text }}</td>
                <td >{{ $item->sponsor_pay_end }}</td>
                <td >{{ $item->sponsor_pay_value }}</td>
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
                        <td class="custom-td-show"
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
                    <td class="custom-td-show"
                        style="padding: 10px;    background: #fbfbfb;">{{$orphan->mother_phone}}</td>
                </tr>

            @endforeach
            @if(count($item->orphans) == 0 )
                <tr class="hide-td details-rows show_{{$item->id}}">
                    <td colspan="6" class="custom-td-show"
                        style="padding: 10px;    background: #fbfbfb;">لا يوجد أيتام مكفولين
                    </td>
                </tr>
            @endif
            <tr><td colspan="6" rowspan="2"></td></tr>
            <tr><td></td></tr>
        @endforeach
        </tbody>
    </table>

    <script>
        //        $(document).on('click', '.details-rows', function () {
        //            alert($(this).index());
        //        });
        $(document).on('click', '.print_excel', function () {

            TableExport.prototype.charset = "charset=utf-8";
            var lang = true;

            var table = TableExport(document.getElementById("requestsTable"), {
                headers: true,
                footers: true,
                formats: ['xlsx'],
                filename: 'الكفلاء',
                bootstrap: true,
                exportButtons: false,
                position: 'bottom',
                ignoreRows: null,
                ignoreCols: null,
                trimWhitespace: true,
                RTL: lang,
                sheetname: 'الكفلاء'
            });

            var exportData = table.getExportData();
            var xlsxData = exportData.requestsTable.xlsx;
            table.export2file(xlsxData.data, xlsxData.mimeType, xlsxData.filename, xlsxData.fileExtension, xlsxData.merges, xlsxData.RTL, xlsxData.sheetname)
        });
    </script>
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
    <!-- Footer -->

@endsection


