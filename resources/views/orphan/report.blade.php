@extends('layouts.main',['title' => 'تقرير الايتام' , 'js'=>'liven'])

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
                                        <option
                                            value="has_sponsor" {{request()->get('ensure_state') =='has_sponsor' ? 'selected':''}}>
                                            أيتام مسندة لهم كفالات
                                        </option>
                                        <option
                                            value="has_not_sponsor" {{request()->get('ensure_state') =='has_not_sponsor' ? 'selected':''}}>
                                            أيتام غير مسندة لهم كفالات
                                        </option>
                                        <option value="1" {{request()->get('ensure_state') =='1' ? 'selected':''}}>
                                            ايتام مسندين بكافل واحد
                                        </option>
                                        <option value="2" {{request()->get('ensure_state') =='2' ? 'selected':''}}>
                                            ايتام مسندين بكافلين اثنين
                                        </option>
                                        <option value="3" {{request()->get('ensure_state') =='3' ? 'selected':''}}>
                                            ايتام مسندين بثلاث كفلاء
                                        </option>
                                        <option
                                            value="more_than_3" {{request()->get('ensure_state') =='more_than_3' ? 'selected':''}}>
                                            ايتام مسندين بإكثر من ثلاث كفلاء
                                        </option>
                                    </select>
                                </label>
                                <label class="col-lg-3 ">
                                    <span class="labels">الجنس: </span>
                                    <select name="gender" class="form-control" id="gender">
                                        <option value="">اختر</option>
                                        <option value="ذكر" {{request()->get('gender') =='ذكر' ? 'selected':''}}>
                                            ذكر
                                        </option>
                                        <option value="أنثى" {{request()->get('gender') =='أنثى' ? 'selected':''}}>
                                            أنثى
                                        </option>
                                    </select>
                                </label>
                                <label class="col-lg-3 ">
                                    <span class="labels">رقم ملف التابع: </span>
                                    <input type="text" name="orphan_file_no" class="form-control"
                                           value="{{request()->get('orphan_file_no')}}">
                                </label>
                                <label class="col-lg-3 ">
                                    <span class="labels">اسم الوالي: </span>
                                    <input type="text" name="mother_name" class="form-control"
                                           value="{{request()->get('mother_name')}}">
                                </label>
                                <label class="col-lg-3 ">
                                    <span class="labels">شهر نزول الكفالة: </span>
                                    <input type="date" name="month_date" class="form-control"
                                           value="{{request()->get('month_date')}}">
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

                    <span class="heading-text">تقرير الايتام</span>

                </div>
            </div>


            <div class="table-responsive">
                <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                    <thead>
                    <tr>
                        <th>ادخل كلمة البحث</th>
                        <th><input type="text" class="form-control search_table" placeholder="البحث"></th>
                        <th colspan="4"></th>
                    </tr>
                    <tr>
                        <th>رقم ملف التابع</th>
                        <th>الاسم</th>
                        <th>النوع</th>
                        <th>العمر</th>
                        <th>إسم الوالي</th>
                        <th>عرض</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $key => $item)
                        <tr class="search-in">
                            <td class="orphan_file_no">{{ $item->orphan_file_no }}</td>
                            <td class="name">{{ $item->name }}</td>
                            <td class="gender">{{ $item->gender }}</td>
                            <td class="orphan_old_year">{{ $item->orphan_old_year }}</td>
                            <td class="mother_name">{{ $item->mother_name }}</td>
                            <td class="text-center">

                                <a href="#" class="show-orphan-btn" RowId="{{$item->id}}">
                                    <i class="  icon-grid info-icon"></i>
                                </a>
                                <input type="hidden" name="orphan" class="orphan" value="{{$item->id}}"/>

                            </td>
                        </tr>
                        @foreach($item->sponsors as $sponsor)
                            @if($loop->index == 0)
                                <tr class="hide-td details-rows show_{{$item->id}}">

                                    <td class="custom-td-show"
                                        style="font-weight:bold;padding: 10px;    background: #efefef;">حذف
                                    </td>
                                    <td class="custom-td-show"
                                        style="font-weight:bold;padding: 10px;    background: #efefef;">رقم ملف
                                        الكافل
                                    </td>
                                    <td colspan="2" class="custom-td-show"
                                        style="font-weight:bold;padding: 10px;    background: #efefef;">الاسم
                                    </td>
                                    <td class="custom-td-show"
                                        style="font-weight:bold;padding: 10px;    background: #efefef;">رقم الجوال
                                    </td>
                                    <td class="custom-td-show"
                                        style="font-weight:bold;padding: 10px;    background: #efefef;">نوع الكفالة
                                    </td>
                                </tr>
                            @endif
                            <tr class="hide-td details-rows show_{{$item->id}}">
                                <td class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">
                                    <a href="#" class="delete-orphan-sponsor-btn"
                                       route="{{route('sponsor.orphan.delete',['sponsor'=>$sponsor->id,'orphan'=>$item->id])}}"
                                       style="margin: 0px 3px;">
                                        <i class="  icon-cancel-square delete-icon"
                                           style=" color: #d84315;font-size: 18px;"></i>
                                    </a>
                                </td>
                                <td class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">{{$sponsor->sponsor_file_no}}</td>
                                <td colspan="2" class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">{{$sponsor->name}}</td>
                                <td class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">{{$sponsor->phone}}</td>
                                <td class="custom-td-show"
                                    style="padding: 10px;    background: #fbfbfb;">{{$sponsor->ensure_type_text}}</td>
                            </tr>
                        @endforeach
                        <tr class="hide-td details-rows  show_{{$item->id}}">
                            <td colspan="6" class="custom-td-show" style="padding: 0px;background: white;">
                                <div style="padding: 20px">
                                    <form action="post" route="{{route('orphan.update',['id'=>$item->id])}}"
                                          class="form-horizontal form-validate-jquery orphan_update_form"
                                          enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $item->id }}" name="user_id" class="user_id">
                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">رقم ملف التابع: </span>
                                                <input disabled="disabled" type="text" name="orphan_file_no"
                                                       class="orphan_file_no form-control "
                                                       value="{{ $item->orphan_file_no }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">الإسم: </span>
                                                <input disabled="disabled" type="text" name="name"
                                                       class="name form-control "
                                                       value="{{ $item->name }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">تاريخ الميلاد: </span>
                                                <input disabled="disabled" type="date" name="orphan_birth_date"
                                                       class="orphan_birth_date form-control "
                                                       value="{{ $item->orphan_birth_date }}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">النوع: </span>
                                                <select disabled="disabled" name="gender" id="gender"
                                                        class="form-control gender">
                                                    <option
                                                        value="ذكر" {{ $item->gender == 'ذكر' ? 'selected' : '' }} >
                                                        ذكر
                                                    </option>
                                                    <option
                                                        value="أنثى" {{ $item->gender == 'أنثى' ? 'selected' : '' }}>
                                                        أنثى
                                                    </option>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">الحي - القرية: </span>
                                                <input disabled="disabled" type="text" name="orphan_country"
                                                       class="orphan_country form-control "
                                                       value="{{ $item->orphan_country }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">رقم الهوية: </span>
                                                <input disabled="disabled" type="text" name="orphan_identity"
                                                       class="orphan_identity form-control "
                                                       value="{{ $item->orphan_identity }}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">المرحلة الدراسية: </span>
                                                <input disabled="disabled" type="text" name="orphan_study_range"
                                                       class="orphan_study_range form-control "
                                                       value="{{ $item->orphan_study_range }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">المدرسة: </span>
                                                <input disabled="disabled" type="text" name="orphan_school_name"
                                                       class="orphan_school_name form-control "
                                                       value="{{ $item->orphan_school_name }}"/>
                                            </label>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">السنة الدراسية: </span>
                                                <input disabled="disabled" type="text" name="orphan_study_year"
                                                       class="orphan_study_year form-control "
                                                       value="{{ $item->orphan_study_year }}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">الحالة الصحية: </span>
                                                <select disabled="disabled" name="orphan_health_state"
                                                        id="orphan_health_state"
                                                        class="form-control orphan_health_state">
                                                    <option
                                                        value="نعم" {{ $item->orphan_health_state == 'مريض' ? 'selected' : '' }} >
                                                        مريض
                                                    </option>
                                                    <option
                                                        value="لا" {{ $item->orphan_health_state == 'سليم' ? 'selected' : '' }}>
                                                        غير مريض
                                                    </option>
                                                </select>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">اسم المرض: </span>
                                                <input disabled="disabled" type="text" name="orphan_disease_name"
                                                       class="orphan_disease_name form-control "
                                                       value="{{ $item->orphan_disease_name }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">نوع المرض: </span>
                                                <input disabled="disabled" type="text" name="orphan_disease_type"
                                                       class="orphan_disease_type form-control "
                                                       value="{{ $item->orphan_disease_type }}"/>
                                            </label>

                                        </div>


                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">رقم ملف الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_file_no"
                                                       class="mother_file_no form-control "
                                                       value="{{ $item->mother_file_no }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">اسم الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_name"
                                                       class="mother_name form-control "
                                                       value="{{ $item->mother_name }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">جوال الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_phone"
                                                       class="mother_phone form-control "
                                                       value="{{ $item->mother_phone }}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">هوية الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_identity"
                                                       class="mother_identity form-control "
                                                       value="{{ $item->mother_identity }}"/>
                                            </label>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">ايبان الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_iban"
                                                       class="mother_iban form-control "
                                                       value="{{ $item->mother_iban }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">إسم البنك: </span>
                                                <input disabled="disabled" type="text" name="bank_name"
                                                       class="bank_name form-control "
                                                       value="{{ $item->bank_name }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">دخل الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_salary"
                                                       class="mother_salary form-control "
                                                       value="{{ $item->mother_salary }}"/>
                                            </label>

                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
    <table class="table datatable-basic table-bordered dataTable no-footer" style="display: none" id="requestsTable">
        <thead>
        <tr class="search-in">
            <th>رقم ملف التابع</th>
            <th>الاسم</th>
            <th>النوع</th>
            <th>العمر</th>
            <th>إسم الوالي</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $item)
                <tr>
                    <td class="orphan_file_no">{{ $item->orphan_file_no }}</td>
                    <td class="name">{{ $item->name }}</td>
                    <td class="gender">{{ $item->gender }}</td>
                    <td class="orphan_old_year">{{ $item->orphan_old_year }}</td>
                    <td class="mother_name">{{ $item->mother_name }}</td>
                </tr>
                @foreach($item->sponsors as $sponsor)
                    @if($loop->index == 0)
                        <tr class="hide-td details-rows show_{{$item->id}}">
                            <td colspan="1" class="custom-td-show"
                                style="font-weight:bold;padding: 10px;    background: #efefef;">رقم ملف الكافل
                            </td>
                            <td colspan="2" class="custom-td-show"
                                style="font-weight:bold;padding: 10px;    background: #efefef;">الاسم
                            </td>
                            <td class="custom-td-show" style="font-weight:bold;padding: 10px;    background: #efefef;">رقم
                                الجوال
                            </td>
                            <td class="custom-td-show" style="font-weight:bold;padding: 10px;    background: #efefef;">نوع
                                الكفالة
                            </td>
                        </tr>
                    @endif
                    <tr class="hide-td details-rows show_{{$item->id}}">
                        <td colspan="1" class="custom-td-show"
                            style="padding: 10px;    background: #fbfbfb;">{{$sponsor->sponsor_file_no}}</td>
                        <td colspan="2" class="custom-td-show"
                            style="padding: 10px;    background: #fbfbfb;">{{$sponsor->name}}</td>
                        <td class="custom-td-show" style="padding: 10px;    background: #fbfbfb;">{{$sponsor->phone}}</td>
                        <td class="custom-td-show"
                            style="padding: 10px;    background: #fbfbfb;">{{$sponsor->ensure_type_text}}</td>
                    </tr>
                @endforeach
                @if(count($item->sponsors) == 0 )
                    <tr class="hide-td details-rows show_{{$item->id}}">
                        <td colspan="5" class="custom-td-show"
                            style="padding: 10px;    background: #fbfbfb;">لا يوجد كفلاء
                        </td>
                    </tr>
                @endif
                <tr>
                    <td colspan="5" rowspan="2"></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
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
                filename: 'submitted applications',
                bootstrap: true,
                exportButtons: false,
                position: 'bottom',
                ignoreRows: null,
                ignoreCols: null,
                trimWhitespace: true,
                RTL: lang,
                sheetname: 'الايتام'
            });

            var exportData = table.getExportData();
            var xlsxData = exportData.requestsTable.xlsx;
            table.export2file(xlsxData.data, xlsxData.mimeType, xlsxData.filename, xlsxData.fileExtension, xlsxData.merges, xlsxData.RTL, xlsxData.sheetname)
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".search_table").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#requests-table tr.search-in").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <!-- Footer -->

@endsection


