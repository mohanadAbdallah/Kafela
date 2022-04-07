@extends('layouts.main',['title' => 'إدارة الاخبار' , 'js'=>'liven'])

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
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>
                <a href="{{route('post.create')}}" class="btn bg-green-400 btn-labeled new-center-btn"
                   style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> جديد
                </a>
                <div class="heading-elements">

                    <span class="heading-text">إدارة الايتام</span>

                </div>
            </div>

            <style>
                table th {
                    font-weight: bold;
                }
            </style>
            <div class="table-responsive">
                <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                    <thead>
                    <tr>
                        <th>العنوان</th>
                        <th>اليتيم</th>
                        <th>الكافل</th>
                        <th>المشتري</th>
                        <th>حالة الخبر</th>
                        <th>عمليات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($posts as $key => $item)
                        <tr>
                            <td class="name" style="max-width: 170px">{{ $item->title ?? '' }}</td>
                            <td class="gender" style="max-width: 170px">{{ $item->orphan->name ?? 'بلا يتيم' }}</td>
                            <td class="orphan_old_year" style="max-width: 170px">

                                @if(isset($item->sponsor->name) and $item->sponsor->name != '')
                                    <a href="#" class="show-item-info"
                                       ItemId="{{$item->id}}"
                                       Info="{{$item->sponsor}}"
                                       fieldNames='{"name":"الاسم","phone":"رقم الجوال","sponsor_file_no":"رقم ملف الكافل"}'>
                                        @endif
                                        {{ $item->sponsor->name ?? 'الكل' }}
                                    </a>
                            </td>
                            <td class="" style="max-width: 170px">
                                <a href="#" class="show-item-info"
                                   ItemId="{{$item->id}}"
                                   Info="{{$item->sponsor_pay}}"
                                   fieldNames='{"name":"الاسم","phone":"رقم الجوال","sponsor_file_no":"رقم ملف الكافل"}'>
                                    {{ $item->sponsor_pay->name ?? '--' }}
                                </a>
                            </td>
                            <td class="status_text">{{ $item->status_text ?? '' }}</td>
                            <td class="text-center" style="padding: 12px 3px;">

                                <a href="{{route('post.show',$item)}}" class="btn  btn-primary"
                                   style="font-size: 12px;padding: 3px 7px ">
                                    عرض
                                </a>
                                <a href="{{route('post.edit',[$item])}}" class="btn  btn-warning"
                                   style="font-size: 12px;padding: 3px 7px ">
                                    تعديل
                                </a>
                                <a href="#" class="delete-post-btn btn btn-danger"
                                   route="{{route('post.destroy',$item)}}" style="font-size: 12px;padding: 3px 7px">
                                    حذف
                                </a>
                                @if($item->status == 0 or $item->status == 4)
                                    <a href="#" class="publish-post-btn btn btn-success"
                                       route="{{route('post.publish',$item)}}" style="font-size: 12px;padding: 3px 7px">
                                        نشر
                                    </a>
                                @endif
                                @if($item->status == 2)
                                    <a href="#" class="pay-post-btn btn btn-success"
                                       route="{{route('post.pay',$item)}}" style="font-size: 12px;padding: 3px 7px">
                                        تم شراءه
                                    </a>
                                    <a href="#" class="cancel-post-btn btn btn-danger"
                                       route="{{route('post.cancel',$item)}}" style="font-size: 12px;padding: 3px 7px">
                                        إلغاء
                                    </a>
                                @endif
                                @if($item->status == 1)
                                    <a href="#" class="cancel-post-btn btn btn-danger"
                                       route="{{route('post.cancel',$item)}}"
                                       style="font-size: 12px;padding: 3px 7px;background-color: #E91E63">
                                        إلغاء
                                    </a>
                                @endif
                                <input type="hidden" name="orphan" class="orphan" value="{{$item->id ?? ''}}"/>

                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div style="padding: 22px;">
                    {{ $posts->links() }}
                </div>

            </div>

        </div>
    </div>
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
            $('.delete_item').prop('checked', $(this).prop('checked'));
        });
    </script>
    <!-- Footer -->

@endsection


