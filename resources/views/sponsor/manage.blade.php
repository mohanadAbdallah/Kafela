@extends('layouts.main',['title' => 'إدارة الكفلاء' , 'js'=>'liven'])

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
                                    <span class="labels">رقم ملف الكافل: </span>
                                    <input type="text" name="sponsor_file_no" class="form-control"
                                           value="{{request()->get('sponsor_file_no')}}">
                                </label>
                                <label class="col-lg-3 ">
                                    <span class="labels">جوال: </span>
                                    <input type="text" name="phone" class="form-control"
                                           value="{{request()->get('phone')}}">
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
                <a href="{{route('sponsor.add')}}" class="btn bg-green-400 btn-labeled new-center-btn"
                   style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> جديد
                </a>
                <a href="{{route('sponsor.delete.multi')}}" route="{{route('sponsor.delete.multi')}}" class="btn bg-danger-400 btn-labeled delete-sponsor-multi-btn"
                   style="float:left;margin-top: -25px;margin-left: 10px">
                     حذف المحدد
                </a>

                <div class="heading-elements">

                    <span class="heading-text">إدارة الايتام</span>

                </div>
            </div>


            <div class="table-responsive">
                <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                    <thead>
                    <tr>
                        <th>تحديد <input type="checkbox" class="delete_all" value=""> </th>
                        <th>رقم ملف الكافل</th>
                        <th>الاسم</th>
                        <th>رقم الجوال</th>
                        <th>نوع الكفالة</th>
                        <th>تاريخ انتهاء الدفع</th>
                        <th>قيمة الدفع</th>
                        <th>عمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $item)
                        <tr>
                            <td class=""><input type="checkbox" class="delete_item" value="{{$item->id}}" /></td>
                            <td class="sponsor_file_no">{{ $item->sponsor_file_no }}</td>
                            <td class="name">{{ $item->name }}</td>
                            <td class="phone">{{ $item->phone }}</td>
                            <td class="ensure_type">{{ $item->ensure_type_text }}</td>
                            <td class="sponsor_pay_end">{{ $item->sponsor_pay_end }}</td>
                            <td class="sponsor_pay_value" >{{ $item->sponsor_pay_value }}</td>
                            <td class="text-center">

                                <a href="#" class="update-sponsor-btn">
                                    <i class="  icon-pencil7 update-icon"></i>
                                </a>
                                <a href="#" class="delete-sponsor-btn"
                                   route="{{route('sponsor.delete',['id'=>$item->id])}}" style="margin: 0px 3px;">
                                    <i class="  icon-cancel-square delete-icon"
                                       style=" color: #d84315;font-size: 18px;"></i>
                                </a>
                                <input type="hidden" name="orphan" class="orphan" value="{{$item->id}}"/>

                            </td>
                        </tr>
                        <tr class="hide-td details-rows">
                            <td colspan="8" class="custom-td-show" style="padding: 0px">
                                <div style="padding: 20px">
                                    <form action="post" route="{{route('sponsor.update',['id'=>$item->id])}}"
                                          class="form-horizontal form-validate-jquery sponsor_update_form"
                                          enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $item->id }}" name="user_id" class="user_id">
                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">رقم ملف الكافل: </span>
                                                <input type="text" name="sponsor_file_no"
                                                       class="sponsor_file_no form-control "
                                                       value="{{ $item->sponsor_file_no }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">الإسم: </span>
                                                <input type="text" name="name" class="name form-control "
                                                       value="{{ $item->name }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">رقم الجوال: </span>
                                                <input type="text" name="phone"
                                                       class="phone form-control "
                                                       value="{{ $item->phone }}"/>
                                            </label>
                                            <label class="col-lg-3 ">
                                                <span class="labels">نوع الكفالة: </span>
                                                <select name="ensure_type" id="ensure_type" class="form-control ensure_type">
                                                    <option value="" {{ $item->ensure_type == '' ? 'selected' : '' }}>اختر</option>
                                                    <option value="1" {{ $item->ensure_type == '1' ? 'selected' : '' }}>شهري</option>
                                                    <option value="2"  {{ $item->ensure_type == '2' ? 'selected' : '' }}>سنة واحدة</option>
                                                    <option value="15"  {{ $item->ensure_type == '15' ? 'selected' : '' }}>سنتين</option>
                                                    <option value="16"  {{ $item->ensure_type == '16' ? 'selected' : '' }}>ثلاث سنوات</option>
                                                    <option value="3" {{ $item->ensure_type == '3' ? 'selected' : '' }}>مقدم لعدد 1 شهر</option>
                                                    <option value="4" {{ $item->ensure_type == '4' ? 'selected' : '' }}>مقدم لعدد 2 شهر</option>
                                                    <option value="5" {{ $item->ensure_type == '5' ? 'selected' : '' }}>مقدم لعدد 3 شهر</option>
                                                    <option value="6" {{ $item->ensure_type == '6' ? 'selected' : '' }}>مقدم لعدد 4 شهر</option>
                                                    <option value="7" {{ $item->ensure_type == '7' ? 'selected' : '' }}>مقدم لعدد 5 شهر</option>
                                                    <option value="8" {{ $item->ensure_type == '8' ? 'selected' : '' }}>مقدم لعدد 6 شهر</option>
                                                    <option value="9" {{ $item->ensure_type == '9' ? 'selected' : '' }}>مقدم لعدد 7 شهر</option>
                                                    <option value="10" {{ $item->ensure_type == '10' ? 'selected' : '' }}>مقدم لعدد 8 شهر</option>
                                                    <option value="11" {{ $item->ensure_type == '11' ? 'selected' : '' }}>مقدم لعدد 9 شهر</option>
                                                    <option value="12" {{ $item->ensure_type == '12' ? 'selected' : '' }}>مقدم لعدد 10 شهر</option>
                                                    <option value="13" {{ $item->ensure_type == '13' ? 'selected' : '' }}>مقدم لعدد 11 شهر</option>
                                                    <option value="14" {{ $item->ensure_type == '14' ? 'selected' : '' }}>مقدم لعدد 12 شهر</option>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">تاريخ الدفع: </span>
                                                <input type="date" name="sponsor_pay_start"
                                                       class="sponsor_pay_start form-control "
                                                       value="{{ $item->sponsor_pay_start }}"/>
                                            </label>
                                            <label class="col-lg-3 ">
                                                <span class="labels">قيمة الكفالة: </span>
                                                <input type="text" name="sponsor_pay_value"
                                                       class="sponsor_pay_value form-control "
                                                       value="{{ $item->sponsor_pay_value }}"/>
                                            </label>
                                            <label class="col-lg-3 ">
                                                <span class="labels">عدد الايتام: </span>
                                                <input type="text" name="orphans_count"
                                                       class="orphans_count form-control "
                                                       value="{{ $item->orphans_count }}"/>
                                            </label>
                                        </div>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary update-button">
                                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                                حفظ التغييرات
                                                <i class="icon-spinner2 spinner position-left hide loader"
                                                   style="margin-top: 3px;float: left;"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div style="padding: 22px;">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
    <table class="table datatable-basic table-bordered dataTable no-footer" style="display: none" id="requestsTable">
        <thead>
        <tr>
            <th>رقم ملف الكافل</th>
            <th>الاسم</th>
            <th>الجوال</th>
            <th>نوع الكفالة </th>
            <th>تاريخ انتهاء الدفع</th>
            <th>قيمة الدفع</th>

        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $item)
            <tr>
                <td class="sponsor_file_no">{{ $item->sponsor_file_no }}</td>
                <td class="name">{{ $item->name }}</td>
                <td class="phone">{{ $item->phone }}</td>
                <td class="ensure_type">{{ $item->ensure_type_text }}</td>
                <td >{{ $item->sponsor_pay_end }}</td>
                <td >{{ $item->sponsor_pay_value }}</td>
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
        $(document).on('change', '.delete_all', function () {
            $('.delete_item').prop('checked',$(this).prop('checked'));
        });
    </script>
    <!-- Footer -->

@endsection


