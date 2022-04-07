@extends('layouts.main',['title' => '' , 'js'=>'home'])
@section('content')
    <style>
        .paid {
            color: #4caf50;
            display: inline-block;
            font-weight: normal;
            text-align: center;
            vertical-align: middle;
            touch-action: manipulation;
            background-image: none;
            border: 1px solid transparent;
            white-space: nowrap;
            padding: 7px 12px;
            font-size: 13px;
            line-height: 1.5384616;
            border-radius: 3px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>

                <div class="heading-elements">

                    <span class="heading-text">الأخبار والاعلانات</span>

                </div>


            </div>
            <div class="panel-body">
                    @foreach($posts as $post)
                        @if($loop->index % 6 == 0)  <div class="row"> @endif
                        <div class="col-md-2" style="margin-bottom: 10px;">

                            <div class="card" style="text-align:center;width: 18rem;box-shadow: 0 1px 2px rgba(0,0,0,.05);
                             {{ $loop->index % 2 == 0 ? 'background: #f5f5f5' : 'background: #fdfcfc' }};
    padding: 9px;border: 1px solid #e2e2e2;
    border-radius: 8px;">
                                <a href="{{route('post.show',$post)}}">
                                    <img src="{{\Illuminate\Support\Facades\Storage::url($post->image)}}"
                                         style="height: 140px" class="img-thumbnail card-img-top"
                                         alt="{{$post->title ?? ''}}">
                                </a>
                                <div class="card-body text-center">
                                    <h5 class="card-title" style="font-size: 12px;">{{$post->title ?? ''}}</h5>
                                    <span>
                                        @if($post->status == 1)
                                            <a href="#" route="{{route('post.reserve',$post)}}"
                                               style="border-radius: 10px"
                                               class="btn btn-success  reserve-post-btn mb-5">حجز الأن</a>
                                        @elseif($post->status == 2)
                                            <span
                                                style="border-radius: 10px"
                                                class="btn btn-light   mb-5">تم حجزه</span>
                                        @else
                                            <span
                                                style="border-radius: 10px"
                                                class="paid  mb-5">تم شراءه</span>
                                        @endif
                                            </span>
                                </div>
                            </div>


                        </div>
                        @if($loop->index % 6 == 5)  </div> @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
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
                @if(session()->get('app_logo') != '') <img width="100" style="border-radius: 10px"
                                                           src="{{ env('APP_URL').'/public/storage/'.session('app_logo') }}"
                                                           alt=""> @endif

            </div>
            <div class="table-responsive">
                <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                    <thead>
                    <tr>
                        <th>رقم ملف التابع</th>
                        <th>الاسم</th>
                        <th>النوع</th>
                        <th>العمر</th>
                        <th>تاريخ اخر سداد</th>
                        <th>عرض</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users[0]->orphans ?? [] as $key => $item)
                        <tr>
                            <td class="orphan_file_no">{{ $visibility->orphan_file_no == null ?  $item->orphan_file_no : '--' }}</td>
                            <td class="name">{{ \Illuminate\Support\Str::limit($item->name,$setting->name_characters_count ?? 200,'...') }}</td>
                            <td class="gender">{{ $visibility->gender == null ?  $item->gender : '--' }}</td>
                            <td class="orphan_old_year">{{  $visibility->orphan_old_year == null ?  $item->orphan_old_year : '--'  }}</td>
                            <td class="">{{ $users[0]->sponsor_pay_start }}</td>
                            <td class="text-center">

                                <a href="#" class="show-orphan-btn" RowId="{{$item->id}}">
                                    <i class="  icon-grid info-icon"></i>
                                </a>
                                <input type="hidden" name="orphan" class="orphan" value="{{$item->id}}"/>

                            </td>
                        </tr>

                        <tr class="hide-td details-rows  show_{{$item->id}}">
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
                                                       value="{{ $visibility->orphan_file_no == null ?  $item->orphan_file_no : '--' }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">الإسم: </span>
                                                <input disabled="disabled" type="text" name="name"
                                                       class="name form-control "
                                                       value="{{ \Illuminate\Support\Str::limit($item->name,$setting->name_characters_count ?? 200,'...') }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">تاريخ الميلاد: </span>
                                                <input disabled="disabled" type="date" name="orphan_birth_date"
                                                       class="orphan_birth_date form-control "
                                                       value="{{ $visibility->orphan_birth_date == null ?  $item->orphan_birth_date : '--' }}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">النوع: </span>
                                                <select disabled="disabled" name="gender" id="gender"
                                                        class="form-control gender">
                                                    @if($visibility->gender == null)
                                                        <option
                                                            value="ذكر" {{ $item->gender == 'ذكر' ? 'selected' : '' }} >
                                                            ذكر
                                                        </option>
                                                        <option
                                                            value="أنثى" {{ $item->gender == 'أنثى' ? 'selected' : '' }}>
                                                            أنثى
                                                        </option>
                                                    @else
                                                        <option value="--" selected>
                                                            --
                                                        </option>
                                                    @endif
                                                </select>
                                            </label>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">الحي - القرية: </span>
                                                <input disabled="disabled" type="text" name="orphan_country"
                                                       class="orphan_country form-control "
                                                       value="{{ $visibility->orphan_country == null ?  $item->orphan_country : '--' }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">رقم الهوية: </span>
                                                <input disabled="disabled" type="text" name="orphan_identity"
                                                       class="orphan_identity form-control "
                                                       value="{{ $visibility->orphan_identity == null ?  $item->orphan_identity : '--' }}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">المرحلة الدراسية: </span>
                                                <input disabled="disabled" type="text" name="orphan_study_range"
                                                       class="orphan_study_range form-control "
                                                       value="{{ $visibility->orphan_study_range == null ?  $item->orphan_study_range : '--' }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">المدرسة: </span>
                                                <input disabled="disabled" type="text" name="orphan_school_name"
                                                       class="orphan_school_name form-control "
                                                       value="{{ $visibility->orphan_school_name == null ?  $item->orphan_school_name : '--' }}"/>
                                            </label>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">السنة الدراسية: </span>
                                                <input disabled="disabled" type="text" name="orphan_study_year"
                                                       class="orphan_study_year form-control "
                                                       value="{{ $visibility->orphan_study_year == null ?  $item->orphan_study_year : '--' }}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">الحالة الصحية: </span>
                                                <select disabled="disabled" name="orphan_health_state"
                                                        id="orphan_health_state"
                                                        class="form-control orphan_health_state">
                                                    @if($visibility->orphan_health_state == null)
                                                        <option
                                                            value="نعم" {{ $item->orphan_health_state == 'مريض' ? 'selected' : '' }} >
                                                            مريض
                                                        </option>
                                                        <option
                                                            value="لا" {{ $item->orphan_health_state == 'سليم' ? 'selected' : '' }}>
                                                            غير مريض
                                                        </option>
                                                    @else
                                                        <option value="--" selected>
                                                            --
                                                        </option>
                                                    @endif
                                                </select>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">اسم المرض: </span>
                                                <input disabled="disabled" type="text" name="orphan_disease_name"
                                                       class="orphan_disease_name form-control "
                                                       value="{{ $visibility->orphan_disease_name == null ?  $item->orphan_disease_name : '--' }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">نوع المرض: </span>
                                                <input disabled="disabled" type="text" name="orphan_disease_type"
                                                       class="orphan_disease_type form-control "
                                                       value="{{ $visibility->orphan_disease_type == null ?  $item->orphan_disease_type : '--' }}"/>
                                            </label>

                                        </div>


                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">رقم ملف الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_file_no"
                                                       class="mother_file_no form-control "
                                                       value="{{ $visibility->mother_file_no == null ?  $item->mother_file_no : '--' }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">اسم الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_name"
                                                       class="mother_name form-control "
                                                       value="{{ $visibility->mother_name == null ?  \Illuminate\Support\Str::limit($item->mother_name,$setting->name_characters_count ?? 200,'...') : '--' }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">جوال الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_phone"
                                                       class="mother_phone form-control "
                                                       value="{{ $visibility->mother_phone == null ?  $item->mother_phone : '--' }}"/>
                                            </label>


                                            <label class="col-lg-3 ">
                                                <span class="labels">هوية الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_identity"
                                                       class="mother_identity form-control "
                                                       value="{{ $visibility->mother_identity == null ?  $item->mother_identity : '--' }}"/>
                                            </label>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                            <label class="col-lg-3 ">
                                                <span class="labels">ايبان الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_iban"
                                                       class="mother_iban form-control "
                                                       value="{{ $visibility->mother_iban == null ?  $item->mother_iban : '--' }}"/>
                                            </label>

                                            <label class="col-lg-3 ">
                                                <span class="labels">دخل الوالي: </span>
                                                <input disabled="disabled" type="text" name="mother_salary"
                                                       class="mother_salary form-control "
                                                       value="{{ $visibility->mother_salary == null ?  $item->mother_salary : '--' }}"/>
                                            </label>

                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
