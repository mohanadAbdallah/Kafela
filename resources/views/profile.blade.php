@extends('layouts.main',['title' => 'تعديل بياناتي' , 'js'=>'liven'])

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
            <form action="post" id="profile_submit_form" route="{{route('profile.update')}}" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">تعديل بياناتي</h5>

                    </div>

                    <div class="panel-body">


                        @if(Auth::user()->role == 'admin')
                        <div class="form-group" style="{{Auth::user()->role != 'admin' ? 'display:none' : ''}}">
                            <label class="col-lg-2 control-label">الاسم:</label>
                            <div class="col-lg-5">
                                <input type="text" name="name" style="width: 100%" class="name form-control " value="{{$user->name ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group" style="{{Auth::user()->role != 'admin' ? 'display:none' : ''}}">
                            <label class="col-lg-2 control-label">البريد الالكتروني:</label>
                            <div class="col-lg-5">
                                <input type="email" name="email" style="width: 100%" class="email form-control " value="{{$user->email ?? ''}}"/>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="col-lg-2 control-label">كلمة السر:</label>
                            <div class="col-lg-5">
                                <input type="password" name="password" style="width: 100%" class="password form-control " value="">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit"  class="btn btn-primary " id="add-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                حفظ التغييرات
                                <i class="icon-spinner2 spinner position-left hide loader" style="margin-top: 3px;float: left;"></i>
                            </button>


                        </div>
                    </div>
                </div>
            </form>

        </div>


    </div>



@endsection
