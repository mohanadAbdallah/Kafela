@extends('layouts.main',['title' => 'إضافة يتيم  جديد' , 'js'=>'liven'])

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


    <!-- Main charts -->
    <div class="row">
        <div class="col-lg-12">
            <form action="post" id="orphan_submit_import_form" route="{{route('orphan.import')}}">
                {{ csrf_field() }}
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إستيراد ملف إكسل</h5>

                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">اختر ملف:</label>
                            <div class="col-lg-5">
                                <input type="file" name="file" class="file form-control " value=""/>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary " id="add-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                إستيراد الملف
                                <i class="icon-spinner2 spinner position-left hide loader"
                                   style="margin-top: 3px;float: left;"></i>
                            </button>


                        </div>

                    </div>
                </div>
            </form>
            {{--add users form --}}
            <form action="post" id="orphan_submit_form" route="{{route('orphan.store')}}"
                  class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة يتيم جديد</h5>

                    </div>

                    <div class="panel-body">


                        <div class="form-group">
                            <label class="col-lg-2 control-label">رقم ملف التابع:</label>
                            <div class="col-lg-5">
                                <input type="text" name="orphan_file_no" class="orphan_file_no form-control " value=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">الاسم:</label>
                            <div class="col-lg-5">
                                <input type="text" name="name" class="name form-control " value=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">رقم ملف الوالي:</label>
                            <div class="col-lg-5">
                                <input type="text" name="mother_file_no" class="mother_file_no form-control " value=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">اسم الوالي:</label>
                            <div class="col-lg-5">
                                <input type="text" name="mother_name" class="mother_name form-control " value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">جوال الوالي:</label>
                            <div class="col-lg-5">
                                <input type="text" name="mother_phone" class="mother_phone form-control " value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">هوية الوالي:</label>
                            <div class="col-lg-5">
                                <input type="text" name="mother_identity" class="mother_identity form-control " value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">ايبان الوالي:</label>
                            <div class="col-lg-5">
                                <input type="text" name="mother_iban" class="mother_iban form-control " value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">إسم البنك:</label>
                            <div class="col-lg-5">
                                <input type="text" name="bank_name" class="bank_name form-control " value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">دخل الوالي:</label>
                            <div class="col-lg-5">
                                <input type="text" name="mother_salary" class="mother_salary form-control " value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">النوع:</label>
                            <div class="col-lg-5">
                                <select name="gender" id="gender" class="form-control gender">
                                    <option value="ذكر"  >
                                        ذكر
                                    </option>
                                    <option value="أنثى">
                                        أنثى
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">تاريخ الميلاد:</label>
                            <div class="col-lg-5">
                                <input type="date" name="orphan_birth_date" class="orphan_birth_date form-control "
                                       value=""/>
                            </div>
                        </div>





                        <div class="form-group">
                            <label class="col-lg-2 control-label">الحي - القرية:</label>
                            <div class="col-lg-5">
                                <input type="text" name="orphan_country" class="orphan_country form-control " value=""/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">رقم الهوية:</label>
                            <div class="col-lg-5">
                                <input type="text" name="orphan_identity" class="orphan_identity form-control " value=""/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">المرحلة الدراسية:</label>
                            <div class="col-lg-5">
                                <input type="text" name="orphan_study_range" class="orphan_study_range form-control " value=""/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">المدرسة:</label>
                            <div class="col-lg-5">
                                <input type="text" name="orphan_school_name" class="orphan_school_name form-control " value=""/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">السنة الدراسية:</label>
                            <div class="col-lg-5">
                                <input type="text" name="orphan_study_year" class="orphan_study_year form-control " value=""/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">الحالة الصحية:</label>
                            <div class="col-lg-5">
                                <select name="orphan_health_state" id="orphan_health_state"
                                        class="form-control orphan_health_state">
                                    <option value="مريض" >
                                        مريض
                                    </option>
                                    <option value="سليم" >
                                        غير مريض
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">اسم المرض:</label>
                            <div class="col-lg-5">
                                <input type="text" name="orphan_disease_name" class="orphan_disease_name form-control " value=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">نوع المرض:</label>
                            <div class="col-lg-5">
                                <input type="text" name="orphan_disease_type" class="orphan_disease_type form-control " value=""/>
                            </div>
                        </div>



                        <div class="text-right">
                            <button type="submit" class="btn btn-primary " id="add-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                إضافة جديد
                                <i class="icon-spinner2 spinner position-left hide loader"
                                   style="margin-top: 3px;float: left;"></i>
                            </button>


                        </div>
                    </div>
                </div>
            </form>

        </div>


    </div>


    <!-- Footer -->

@endsection


