@extends('layouts.main',['title' => 'إضافة كافل  جديد' , 'js'=>'liven'])

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
            <form action="post" id="sponsor_submit_import_form" route="{{route('sponsor.import')}}">
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
            <form action="post" id="sponsor_submit_form" route="{{route('sponsor.store')}}"
                  class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة كافل جديد</h5>

                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">الاسم:</label>
                            <div class="col-lg-5">
                                <input type="text" name="name" class="name form-control " value=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">رقم الجوال:</label>
                            <div class="col-lg-5">
                                <input type="text" name="phone" class="phone form-control " value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">نوع الكفالة:</label>
                            <div class="col-lg-5">
                                <select name="ensure_type" id="ensure_type" class="form-control ensure_type">
                                    <option value="1" selected>شهري</option>
                                    <option value="2">سنة واحدة</option>
                                    <option value="15">سنتين</option>
                                    <option value="16">ثلاث سنوات</option>
                                    <option value="3">مقدم لعدد 1 شهر</option>
                                    <option value="4">مقدم لعدد 2 شهر</option>
                                    <option value="5">مقدم لعدد 3 شهر</option>
                                    <option value="6">مقدم لعدد 4 شهر</option>
                                    <option value="7">مقدم لعدد 5 شهر</option>
                                    <option value="8">مقدم لعدد 6 شهر</option>
                                    <option value="9">مقدم لعدد 7 شهر</option>
                                    <option value="10">مقدم لعدد 8 شهر</option>
                                    <option value="11">مقدم لعدد 9 شهر</option>
                                    <option value="12">مقدم لعدد 10 شهر</option>
                                    <option value="13">مقدم لعدد 11 شهر</option>
                                    <option value="14">مقدم لعدد 12 شهر</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">عدد الايتام:</label>
                            <div class="col-lg-5">
                                <input type="text" name="orphans_count" class="orphans_count form-control " value=""/>
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


