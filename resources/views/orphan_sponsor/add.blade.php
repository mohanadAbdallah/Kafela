@extends('layouts.main',['title' => 'إسناد كافل ليتيم' , 'js'=>'liven'])

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
            <form action="post" id="orphan_sponsor_submit_form" route="{{route('orphan.sponsor.store')}}"
                  class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إسناد كافل ليتيم</h5>

                    </div>

                    <div class="panel-body">


                        <div class="form-group">
                            <label class="col-lg-2 control-label">إختر كافل:</label>
                            <div class="col-lg-5">
                                <select class=" select sponsor_id" id="sponsor_id" name="sponsor_id"  data-fouc>
                                    @foreach($sponsors as $items)
                                        <option value="{{$items->id}}">{{$items->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">إختر يتيم:</label>
                            <div class="col-lg-5">
                                <select name="orphan_id[]" id="orphan_id" class="select orphan_id" multiple="multiple" data-fouc>
                                    @foreach($orphans as $items)
                                        <option value="{{$items->id}}">{{$items->name .' - '. $items->orphan_old_year.' عام '.' - '.count($items->sponsors).' كفالة '}}</option>
                                    @endforeach
                                </select>
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

