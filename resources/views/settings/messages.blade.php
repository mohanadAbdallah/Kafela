@extends('layouts.main',['title' => 'ارسال رسائل' , 'js'=>'liven'])

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
            <form action="post" id="message_submit_form" route="{{route('message.store')}}"
                  class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">ارسال رسائل</h5>

                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">المرسل اليهم:</label>
                            <div class="col-lg-5">
                                <select name="receive_type" id="receive_type" class="form-control receive_type">
                                    <option value="orphan"  >
                                        الأيتام
                                    </option>
                                    <option value="sponsor">
                                        الكفلاء
                                    </option>
                                    <option value="orphans_has_sponsor">
                                         المسند لهم - الايتام
                                    </option>
                                    <option value="sponsor_has_orphans">
                                        المسند لهم - كفلاء
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">نص رسالة :</label>
                            <div class="col-lg-5">
                                <textarea name="message_text" style="width: 100%" class="message_text form-control "
                                          rows="5"></textarea>
                            </div>
                        </div>



                        <div class="text-right">
                            <button type="submit" class="btn btn-primary " id="add-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                ارسال
                                <i class="icon-spinner2 spinner position-left hide loader"
                                   style="margin-top: 3px;float: left;"></i>
                            </button>


                        </div>
                    </div>
                </div>
            </form>

            <form action="post" id="message_send_pay_submit_form" route="{{route('message.send.pay.store')}}"
                  class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">ارسال رسائل دفع</h5>

                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">شهر الدفع:</label>
                            <div class="col-lg-5">
                                <input type="date" name="month_date" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">نص الرسالة - الكافل :</label>
                            <div class="col-lg-5">
                                <textarea name="message_thanks_sponsor" style="width: 100%" class="message_thanks_sponsor form-control "
                                          rows="5">{{$settings->message_thanks_sponsor}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">نص الرسالة - اليتيم :</label>
                            <div class="col-lg-5">
                                <textarea name="message_orphan_received" style="width: 100%" class="message_orphan_received form-control "
                                          rows="5">{{$settings->message_orphan_received}}</textarea>
                            </div>
                        </div>



                        <div class="text-right">
                            <button type="submit" class="btn btn-primary " id="add-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                ارسال
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
