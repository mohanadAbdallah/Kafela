@extends('layouts.main',['title' => 'اعدادات' , 'js'=>'liven'])

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
            {{--add users form --}}
            <form action="post" id="settings_submit_form" route="{{route('settings.update')}}"
                  class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">اعدادات</h5>

                    </div>

                    <div class="panel-body">


                        <div class="form-group">
                            <label class="col-lg-2 control-label">نص رسالة لتذكير الدفع الشهري:</label>
                            <div class="col-lg-5">
                                <textarea name="message_monthly_pay" style="width: 100%" class="message_monthly_pay form-control "
                                          rows="5">{{$settings->message_monthly_pay ?? ''}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">نص رسالة لتذكير لتجديد الدفع السنوي:</label>
                            <div class="col-lg-5">
                                <textarea name="message_yearly_pay" style="width: 100%" class="message_yearly_pay form-control "
                                          rows="5">{{$settings->message_yearly_pay ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">نص رسالة لتذكير الدفع حسب مدة:</label>
                            <div class="col-lg-5">
                                <textarea name="message_by_month_pay" style="width: 100%" class="message_by_month_pay form-control "
                                          rows="5">{{$settings->message_by_month_pay ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">نص رسالة تفيد بأن مبلغ الكفالة نزل في حساب اليتيم(للكافل):</label>
                            <div class="col-lg-5">
                                <textarea name="message_thanks_sponsor" style="width: 100%" class="message_thanks_sponsor form-control "
                                          rows="5">{{$settings->message_thanks_sponsor ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">نص رسالة تفيد بأن مبلغ الكفالة نزل ( لولي اليتيم):</label>
                            <div class="col-lg-5">
                                <textarea name="message_orphan_received" style="width: 100%" class="message_orphan_received form-control "
                                          rows="5">{{$settings->message_orphan_received ?? ''}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">يوم رسائل التذكير (يوم من الشهر):</label>
                            <div class="col-lg-5">
                                <input type="number" name="date_send_messages" style="width: 100%" class="date_send_messages form-control "
                                       value="{{$settings->date_send_messages ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">عدد احرف اسم اليتيم عند الكافل:</label>
                            <div class="col-lg-5">
                                <input type="number" name="name_characters_count" style="width: 100%" class="name_characters_count form-control "
                                       value="{{$settings->name_characters_count ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">إخفاء  البيانات عند الكافل:</label>
                            <div class="col-lg-5">
                                <select name="visibility[]" id="visibility" class="select visibility" multiple="multiple" data-fouc>
                                    <option value="orphan_file_no" {{isset($visibility->orphan_file_no) ? $visibility->orphan_file_no == 'orphan_file_no' ? 'selected' : '' : ''}}>رقم ملف اليتيم</option>
                                    <option value="gender" {{isset($visibility->gender) ? $visibility->gender == 'gender' ? 'selected' : '' : ''}}>النوع</option>
                                    <option value="orphan_birth_date" {{isset($visibility->orphan_birth_date) ? $visibility->orphan_birth_date == 'orphan_birth_date' ? 'selected' : '' : ''}}>تاريخ ميلاد اليتيم</option>
                                    <option value="orphan_old_year" {{isset($visibility->orphan_old_year) ? $visibility->orphan_old_year == 'orphan_old_year' ? 'selected' : '' : ''}}>عمر اليتيم</option>
                                    <option value="orphan_country" {{isset($visibility->orphan_country) ? $visibility->orphan_country == 'orphan_country' ? 'selected' : '' : ''}}>القرية - الحي</option>
                                    <option value="orphan_identity" {{isset($visibility->orphan_identity) ? $visibility->orphan_identity == 'orphan_identity' ? 'selected' : '' : ''}}>هوية اليتيم</option>
                                    <option value="orphan_age_range" {{isset($visibility->orphan_age_range) ? $visibility->orphan_age_range == 'orphan_age_range' ? 'selected' : '' : ''}}>المرحلة العمرية</option>
                                    <option value="orphan_study_range" {{isset($visibility->orphan_study_range) ? $visibility->orphan_study_range == 'orphan_study_range' ? 'selected' : '' : ''}}>المرحلة الدراسية</option>
                                    <option value="orphan_school_name" {{isset($visibility->orphan_school_name) ? $visibility->orphan_school_name == 'orphan_school_name' ? 'selected' : '' : ''}}>اسم المدرسة</option>
                                    <option value="orphan_study_year" {{isset($visibility->orphan_study_year) ? $visibility->orphan_study_year == 'orphan_study_year' ? 'selected' : '' : ''}}>السنة الدراسية</option>
                                    <option value="orphan_health_state" {{isset($visibility->orphan_health_state) ? $visibility->orphan_health_state == 'orphan_health_state' ? 'selected' : '' : ''}}>حالة اليتيم الصحية</option>
                                    <option value="orphan_disease_name" {{isset($visibility->orphan_disease_name) ? $visibility->orphan_disease_name == 'orphan_disease_name' ? 'selected' : '' : ''}}>اسم المرض</option>
                                    <option value="orphan_disease_type" {{isset($visibility->orphan_disease_type) ? $visibility->orphan_disease_type == 'orphan_disease_type' ? 'selected' : '' : ''}}>نوع المرض</option>
                                    <option value="mother_file_no" {{isset($visibility->mother_file_no) ? $visibility->mother_file_no == 'mother_file_no' ? 'selected' : '' : ''}}>رقم ملف الولي</option>
                                    <option value="mother_name" {{isset($visibility->mother_name) ? $visibility->mother_name == 'mother_name' ? 'selected' : '' : ''}}>اسم الولي</option>
                                    <option value="mother_phone" {{isset($visibility->mother_phone) ? $visibility->mother_phone == 'mother_phone' ? 'selected' : '' : ''}}>رقم جوال الولي</option>
                                    <option value="mother_identity" {{isset($visibility->mother_identity) ? $visibility->mother_identity == 'mother_identity' ? 'selected' : '' : ''}}>هوية الولي</option>
                                    <option value="mother_iban" {{isset($visibility->mother_iban) ? $visibility->mother_iban == 'mother_iban' ? 'selected' : '' : ''}}>ايبان الولي</option>
                                    <option value="mother_salary" {{isset($visibility->mother_salary) ? $visibility->mother_salary == 'mother_salary' ? 'selected' : '' : ''}}>دخل ولي اليتيم</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">اسم مستخدم خدمة الرسائل:</label>
                            <div class="col-lg-5">
                                <input type="text" name="message_user_name" style="width: 100%" class="message_user_name form-control "
                                       value="{{$settings->message_user_name ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">كلمة سر خدمة الرسائل:</label>
                            <div class="col-lg-5">
                                <input type="text" name="message_password" style="width: 100%" class="message_password form-control "
                                       value="{{$settings->message_password ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">اسم مرسل خدمة الرسائل:</label>
                            <div class="col-lg-5">
                                <input type="text" name="message_sender_name" style="width: 100%" class="message_sender_name form-control "
                                       value="{{$settings->message_sender_name ?? ''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">اسم الموقع:</label>
                            <div class="col-lg-5">
                                <input type="text" name="website_name" style="width: 100%" class="website_name form-control "
                                       value="{{$settings->website_name ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">شعار الموقع:</label>
                            <div class="col-lg-5">
                                <input type="file" name="logo" style="width: 100%" class="logo form-control "
                                      >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">الحالي:</label>
                             <img width="100" style="border-radius: 10px" src="{{  env('APP_URL').'/public/storage/'.session('app_logo') }}" alt="لا يوجد">

                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">حالة الموقع:</label>
                            <div class="col-lg-5">
                                <select name="is_website_on" id="is_website_on" class="select is_website_on"  data-fouc>
                                    <option value="1" {{isset($settings->is_website_on) ? $settings->is_website_on == 1 ? 'selected' : '' : ''}}>يعمل</option>
                                    <option value="0" {{isset($settings->is_website_on) ? $settings->is_website_on == 0 ? 'selected' : '' : ''}}>متوقف</option>

                                </select>
                            </div>
                        </div>


                        <div class="text-right">
                            <button type="submit" class="btn btn-primary " id="add-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                حفظ التغييرات
                                <i class="icon-spinner2 spinner position-left hide loader"
                                   style="margin-top: 3px;float: left;"></i>
                            </button>


                        </div>
                    </div>
                </div>
            </form>

        </div>


    </div>


@endsection
@section('js_assets')
    <script type="text/javascript" src="{{ asset('js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>
@endsection
@section('js_code')
    <script>
        $('.select').select2({
            minimumResultsForSearch: "-1",
            tags:['red'],
        });
    </script>
@endsection
