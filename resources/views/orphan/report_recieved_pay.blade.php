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
                <table class="table datatable-basic table-bordered dataTable no-footer" id="requestsTable">
                    <thead>
                    <tr>
                        <th>ادخل كلمة البحث</th>
                        <th><input type="text" class="form-control search_table" placeholder="البحث"></th>
                        <th colspan="3"></th>
                        <th>عدد الايتام</th>
                        <th class="orphan_count"></th>
                    </tr>
                    <tr>
                        <th>رقم ملف التابع</th>
                        <th>الاسم</th>
                        <th>النوع</th>
                        <th>العمر</th>
                        <th>إسم الوالي</th>
                        <th>رقم ملف الوالي</th>
                        <th>إسم الكافل</th>
                        <th style="display: none">إسم البنك</th>
                        <th style="display: none">رقم الحساب</th>
                        <th style="display: none">التكرار</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $count = 0; @endphp
                    @foreach($users as $key => $sponsors)
                        @foreach($sponsors->orphans as $item)
                            @php $count+=1; @endphp
                        <tr class="search-in mother-{{ $item->mother_file_no }}" identity="mother-{{ $item->mother_file_no }}" >
                            <td class="orphan_file_no">{{ $item->orphan_file_no }}</td>
                            <td class="name">{{ $item->name }}</td>
                            <td class="gender">{{ $item->gender }}</td>
                            <td class="orphan_old_year">{{ $item->orphan_old_year }}</td>
                            <td class="mother_name">{{ $item->mother_name }}</td>
                            <td class="mother_name">{{ $item->mother_file_no }}</td>
                            <td class="mother_name">{{ $sponsors->name }}</td>
                            <td class="bank_name" style="display: none">{{ $item->bank_name }}</td>
                            <td class="mother_iban" style="display: none">{{ $item->mother_iban }}</td>
                            <td class="mother_repeat" style="display: none"></td>
                        </tr>
                        <script>
                            $('.orphan_count').text("{{$count}}");
                        </script>
                        @endforeach
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <script>
        //        $(document).on('click', '.details-rows', function () {
        //            alert($(this).index());
        //        });
        $('#requestsTable tbody tr').each(function(){
           var class_identity = $(this).attr('identity');
           var count = $('.'+class_identity).length;
           $(this).find('.mother_repeat').text(count);
           $('.'+class_identity).not(':first').remove();

        })
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
                $("#requestsTable tr.search-in").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <!-- Footer -->

@endsection


