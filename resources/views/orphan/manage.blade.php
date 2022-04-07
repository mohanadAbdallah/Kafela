@extends('layouts.main',['title' => 'إدارة الايتام' , 'js'=>'liven'])

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
                <a href="{{route('orphan.add')}}" class="btn bg-green-400 btn-labeled new-center-btn"
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

                        <th>رقم ملف التابع</th>
                        <th>الاسم</th>
                        <th>النوع</th>
                        <th>العمر</th>
                        <th>إسم الوالي</th>
                        <th>عمليات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $key => $item)
                        <tr>
                            <td class=""><input type="checkbox" class="delete_item" value="{{$item->id ?? ''}}" /></td>
                            <td class="orphan_file_no">{{ $item->orphan_file_no ?? '' }}</td>
                            <td class="name">{{ $item->name ?? '' }}</td>
                            <td class="gender">{{ $item->gender ?? '' }}</td>
                            <td class="orphan_old_year">{{ $item->orphan_old_year ?? '' }}</td>
                            <td class="mother_name">{{ $item->mother_name ?? '' }}</td>
                            <td class="text-center">

                                <a href="#" class="update-orphan-btn">
                                    <i class="  icon-pencil7 update-icon"></i>
                                </a>
                                <a href="#" class="delete-orphan-btn"
                                   route="{{route('orphan.delete',['id'=>$item->id ?? ''])}}" style="margin: 0px 3px;">
                                    <i class="  icon-cancel-square delete-icon"
                                       style=" color: #d84315;font-size: 18px;"></i>
                                </a>
                                <input type="hidden" name="orphan" class="orphan" value="{{$item->id ?? ''}}"/>

                            </td>
                        </tr>
                        <tr class="hide-td details-rows">
                            <td colspan="7" class="custom-td-show" style="padding: 0px">
                                <div style="padding: 20px">
                                    <form action="post" route="{{route('orphan.update',['id'=>$item->id ?? ''])}}"
                                          class="form-horizontal form-validate-jquery orphan_update_form"
                                          enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $item->id }}" name="user_id" class="user_id">
                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">رقم ملف التابع: </span>
                                                <input type="text" name="orphan_file_no"
                                                       class="orphan_file_no form-control "
                                                       value="{{ $item->orphan_file_no  ?? ''}}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">الإسم: </span>
                                                <input type="text" name="name" class="name form-control "
                                                       value="{{ $item->name  ?? ''}}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">تاريخ الميلاد: </span>
                                                <input type="date" name="orphan_birth_date"
                                                       class="orphan_birth_date form-control "
                                                       value="{{ $item->orphan_birth_date  ?? ''}}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">النوع: </span>
                                                <select name="gender" id="gender" class="form-control gender">
                                                    <option value="ذكر" {{ $item->gender == 'ذكر' ? 'selected' : '' }} >
                                                        ذكر
                                                    </option>
                                                    <option value="أنثى" {{ $item->gender == 'أنثى' ? 'selected' : '' }}>
                                                        أنثى
                                                    </option>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">الحي - القرية: </span>
                                                <input type="text" name="orphan_country"
                                                       class="orphan_country form-control "
                                                       value="{{ $item->orphan_country ?? '' }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">رقم الهوية: </span>
                                                <input type="text" name="orphan_identity"
                                                       class="orphan_identity form-control "
                                                       value="{{ $item->orphan_identity ?? '' }}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">المرحلة الدراسية: </span>
                                                <input type="text" name="orphan_study_range"
                                                       class="orphan_study_range form-control "
                                                       value="{{ $item->orphan_study_range ?? '' }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">المدرسة: </span>
                                                <input type="text" name="orphan_school_name"
                                                       class="orphan_school_name form-control "
                                                       value="{{ $item->orphan_school_name  ?? ''}}"/>
                                            </label>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">السنة الدراسية: </span>
                                                <input type="text" name="orphan_study_year"
                                                       class="orphan_study_year form-control "
                                                       value="{{ $item->orphan_study_year ?? '' }}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">الحالة الصحية: </span>
                                                <select name="orphan_health_state" id="orphan_health_state"
                                                        class="form-control orphan_health_state">
                                                    <option value="نعم" {{ $item->orphan_health_state == 'مريض' ? 'selected' : '' }} >
                                                        مريض
                                                    </option>
                                                    <option value="لا" {{ $item->orphan_health_state == 'سليم' ? 'selected' : '' }}>
                                                        غير مريض
                                                    </option>
                                                </select>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">اسم المرض: </span>
                                                <input type="text" name="orphan_disease_name"
                                                       class="orphan_disease_name form-control "
                                                       value="{{ $item->orphan_disease_name  ?? ''}}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">نوع المرض: </span>
                                                <input type="text" name="orphan_disease_type"
                                                       class="orphan_disease_type form-control "
                                                       value="{{ $item->orphan_disease_type  ?? ''}}"/>
                                            </label>

                                        </div>


                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">رقم ملف الوالي: </span>
                                                <input type="text" name="mother_file_no"
                                                       class="mother_file_no form-control "
                                                       value="{{ $item->mother_file_no  ?? ''}}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">اسم الوالي: </span>
                                                <input type="text" name="mother_name" class="mother_name form-control "
                                                       value="{{ $item->mother_name  ?? ''}}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">جوال الوالي: </span>
                                                <input type="text" name="mother_phone"
                                                       class="mother_phone form-control "
                                                       value="{{ $item->mother_phone  ?? ''}}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">هوية الوالي: </span>
                                                <input type="text" name="mother_identity"
                                                       class="mother_identity form-control "
                                                       value="{{ $item->mother_identity ?? '' }}"/>
                                            </label>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">ايبان الوالي: </span>
                                                <input type="text" name="mother_iban" class="mother_iban form-control "
                                                       value="{{ $item->mother_iban  ?? ''}}"/>
                                            </label>
                                            <label class="col-lg-3 ">
                                                <span class="labels">إسم البنك: </span>
                                                <input type="text" name="bank_name" class="bank_name form-control "
                                                       value="{{ $item->bank_name  ?? ''}}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">دخل الوالي: </span>
                                                <input type="text" name="mother_salary"
                                                       class="mother_salary form-control "
                                                       value="{{ $item->mother_salary  ?? ''}}"/>
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
            <th>رقم ملف التابع</th>
            <th>الاسم</th>
            <th>النوع</th>
            <th>العمر</th>
            <th>إسم الوالي</th>
            <th>عمليات</th>
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
                sheetname: 'submitted applications'
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


