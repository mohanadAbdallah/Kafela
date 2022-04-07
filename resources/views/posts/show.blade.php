@extends('layouts.main',['title' => 'عرض خبر' , 'js'=>'liven'])

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
            <form action="post" method="post" id="post_submit_form" route="{{route('post.update',[$post])}}"
                  class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
{{--                @method('put')--}}
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">

                    </div>

                    <div class="panel-body">



                        <div class="form-group">
                            <div class="col-lg-12">
                            {!! $post->content ?? '' !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">اليتيم:</label>
                            <div class="col-lg-5">
                                {{$post->orphan->name ?? '--'}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">الكافل:</label>
                            <div class="col-lg-5">
                                {{$post->sponsor->name ?? '--'}}
                            </div>
                        </div>

                        <div class="text-right">
                            @if($post->status == 1 or $post->status == 0)
                                <a href="#" route="{{route('post.reserve',$post)}}"
                                   style="border-radius: 3px"
                                   class="btn btn-success  reserve-post-btn mb-5">حجز الأن</a>
                            @elseif($post->status == 2)
                                <span
                                    style="border-radius: 3px"
                                    class="btn btn-light   mb-5">تم حجزه</span>
                            @else
                                <span
                                    style="border-radius: 3px"
                                    class="paid  mb-5">تم شراءه</span>
                            @endif


                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <span>

                                            </span>
                            </div>
                        </div>




                    </div>
                </div>
            </form>

        </div>


    </div>


    <!-- Footer -->

@endsection

@section('js_code')

    <script>
        CKEDITOR.addCss(
            'html {background: whitesmoke;}' +
            'body.document-editor { margin: 0.5cm auto; border: 1px #D3D3D3 solid; border-radius: 5px; background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); }' +
            'body.document-editor, div.cke_editable { width: 570px;    min-height: 240px; padding: 1cm 2cm 2cm; } ' +
            'body.document-editor table td > p, div.cke_editable table td > p { margin-top: 0; margin-bottom: 0; padding: 4px 0 3px 5px;} ' +
            'blockquote { font-family: sans-serif, Arial, Verdana, "Trebuchet MS", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; } ');

        CKEDITOR.replace('editor', {
            // Define the toolbar: https://ckeditor.com/docs/ckeditor4/latest/features/toolbar
            // The full preset from CDN which we used as a base provides more features than we need.
            // Also by default it comes with a 3-line toolbar. Here we put all buttons in two rows.
            toolbar: [{
                name: 'clipboard',
                items: ['PasteFromWord', '-', 'Undo', 'Redo']
            },
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'Subscript', 'Superscript']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table']
                },
                {
                    name: 'editing',
                    items: ['Scayt']
                },
                '/',

                {
                    name: 'styles',
                    items: ['Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor', 'CopyFormatting']
                },
                {
                    name: 'align',
                    items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                },
                {
                    name: 'document',
                    items: ['Print', 'PageBreak', 'Source']
                }
            ],

            // Since we define all configuration options here, let's instruct CKEditor 4 to not load config.js which it does by default.
            // One HTTP request less will result in a faster startup time.
            // For more information check https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-customConfig
            customConfig: '',

            // Upload images to a CKFinder connector (note that the response type is set to JSON).
            uploadUrl: "{{route('uploadPostImages')}}",

            // Configure your file manager integration. This example uses CKFinder 3 for PHP.
            filebrowserBrowseUrl: "{{route('uploadPostImages')}}",
            filebrowserImageBrowseUrl: "{{route('uploadPostImages')}}",
            filebrowserUploadUrl: "{{route('uploadPostImages')}}",
            filebrowserImageUploadUrl: "{{route('uploadPostImages')}}",

            // Sometimes applications that convert HTML to PDF prefer setting image width through attributes instead of CSS styles.
            // For more information check:
            //  - About Advanced Content Filter: https://ckeditor.com/docs/ckeditor4/latest/guide/dev_advanced_content_filter
            //  - About Disallowed Content: https://ckeditor.com/docs/ckeditor4/latest/guide/dev_disallowed_content
            //  - About Allowed Content: https://ckeditor.com/docs/ckeditor4/latest/guide/dev_allowed_content_rules
            disallowedContent: 'img{width,height,float}',
            extraAllowedContent: 'img[width,height,align]',

            // Enabling extra plugins, available in the full-all preset: https://ckeditor.com/cke4/presets
            extraPlugins: 'colorbutton,font,justify,print,tableresize,uploadimage,uploadfile,pastefromword,liststyle,pagebreak',


            // An array of stylesheets to style the WYSIWYG area.
            // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
            contentsCss: [
                'http://cdn.ckeditor.com/4.14.1/full-all/contents.css',
                'assets/css/pastefromword.css'
            ],

            // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
            bodyClass: 'document-editor',

            // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
            format_tags: 'p;h1;h2;h3;pre',

            // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
            removeDialogTabs: 'image:advanced;link:advanced',

            height : 400,

            stylesSet: [
                /* Inline Styles */
                {
                    name: 'Marker',
                    element: 'span',
                    attributes: {
                        'class': 'marker'
                    }
                },
                {
                    name: 'Cited Work',
                    element: 'cite'
                },
                {
                    name: 'Inline Quotation',
                    element: 'q'
                },

                /* Object Styles */
                {
                    name: 'Special Container',
                    element: 'div',
                    styles: {
                        padding: '5px 10px',
                        background: '#eee',
                        border: '1px solid #ccc'
                    }
                },
                {
                    name: 'Compact table',
                    element: 'table',
                    attributes: {
                        cellpadding: '5',
                        cellspacing: '0',
                        border: '1',
                        bordercolor: '#ccc'
                    },
                    styles: {
                        'border-collapse': 'collapse'
                    }
                },
                {
                    name: 'Borderless Table',
                    element: 'table',
                    styles: {
                        'border-style': 'hidden',
                        'background-color': '#E6E6FA'
                    }
                },
                {
                    name: 'Square Bulleted List',
                    element: 'ul',
                    styles: {
                        'list-style-type': 'square'
                    }
                }
            ]
        });

    </script>
@endsection
@section('js_assets')
    <script src="https://cdn.ckeditor.com/4.14.1/full-all/ckeditor.js"></script>


@endsection
