@extends('layouts.main',['title' => '' , 'js'=>'home'])
@section('content')

    <!-- Main charts -->
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>

                <div class="heading-elements">

                    <span class="heading-text">الصفحة الرئيسية</span>

                </div>
            </div>
            <style>
                .custom-td-show .labels {
                    color: #4CAF50 !important;
                }
            </style>
            <div class="panel-body" style="text-align: center">
                <h2>مرحبا بكم في موقع</h2>
                <h1 style="    font-size: 3em;font-weight: bold;color: #4caf50;">{{ session()->get('app_name') }}</h1>
                @if(session()->get('app_logo') != '') <img width="100" style="border-radius: 10px" src="{{ env('APP_URL').'/public/storage/'.session('app_logo') }}" alt=""> @endif

            </div>
            <div class="table-responsive">
                <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                    <thead>
                    <tr>
                        <th colspan="5" style="text-align: center">بياناتي</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr class="  show_{{$item->id}}">
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
                    </tbody>
                </table>
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