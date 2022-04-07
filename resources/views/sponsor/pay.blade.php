@extends('layouts.main',['title' => 'تسجيل دفع الكفلاء' , 'js'=>'liven'])

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

    <style>
        .select2-container-multi .select2-choices .select2-search-choice>div {
            background-color: #56c35a !important;
        }
    </style>
    <!-- Main charts -->
    <div class="row">
        <div class="col-lg-12">

            {{--add users form --}}
            <form action="post" id="sponsor_pay_submit_form" route="{{route('sponsor.pay.store')}}"
                  class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">تسجيل دفع الكفلاء</h5>

                    </div>

                    <div class="panel-body">


                        <div class="form-group">
                            <label class="col-lg-2 control-label">إختر كافل:</label>
                            <div class="col-lg-6">
                                <select class=" select user_id select-sponsor" id="user_id" name="user_id"  data-fouc>
                                    @foreach($sponsors as $items)
                                        <option value="{{$items->id}}" EnsureType="{{$items->ensure_type_text}}">اسم الكافل: {{$items->name}},  رقم الجوال: {{$items->phone}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">تاريخ الدفع:</label>
                            <div class="col-lg-6">
                                <input type="date" name="sponsor_pay_start" class="sponsor_pay_start form-control "
                                       value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">قيمة الدفع:</label>
                            <div class="col-lg-6">
                                <input type="number" name="sponsor_pay_value" class="sponsor_pay_value form-control "
                                       value="" placeholder="### ريال سعودي "/>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary " id="add-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                تسجيل الدفع
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

