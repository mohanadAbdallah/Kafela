/**
 * Created by mhilles on 19/06/2017.
 */

//////////////////////////////////////////////////////////////////////////////////////////////
//                              Start Of Common Functions                                   //
//////////////////////////////////////////////////////////////////////////////////////////////


function validation(jsonObject, elementId, ajax_response, form_id) {
    if (!ajax_response) {// if ajax return error process
        //validation inputs of laravel -- input names
        if (jsonObject.hasOwnProperty(elementId)) {
            $(form_id).find('#' + elementId).parent().find('.validation-error').remove();
            $(form_id).find('#' + elementId).parent().parent().addClass("has-error  has-feedback");
            $(form_id).find('#' + elementId).after($('.validation').html());
            $(form_id).find('#' + elementId).parent().find('span').text(jsonObject[elementId]);
        } else {
            $(form_id).find('#' + elementId).parent().parent().removeClass("has-error  has-feedback");
            $(form_id).find('#' + elementId).parent().find('.validation-error').remove();
        }
    } else {
        $(form_id).find('#' + elementId).parent().parent().removeClass("has-error  has-feedback");
        $(form_id).find('#' + elementId).parent().find('.validation-error').remove();
    }

}

function loader(btn, turn) {
    // trun : true to show loader , false to hide
    if (turn) {
        btn.parent().attr('disabled', true);
        btn.removeClass('hide');
        btn.addClass('show');
    } else {
        btn.parent().attr('disabled', false);
        btn.removeClass('show');
        btn.addClass('hide');
    }
}

function blockLoader(block) {
    $(block).block({
        message: $('.blockui-animation-container'),

        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            width: 36,
            height: 36,
            color: '#fff',
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });

    var animation = $(this).data("animation");
    $('.blockui-animation-container').addClass("animated " + animation).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
        $(this).removeClass("animated " + animation);
    });
}

function resultMessage(title, body, type, button_color, timer) {
    swal({
        title: title,
        text: body,
        confirmButtonColor: button_color,
        type: type,
        timer: timer
    });
}

function cancelDelete() {
    swal({
        title: "تم إلغاء الامر",
        text: "لقد قمت بالتراجع عن العملية",
        confirmButtonColor: "#2196F3",
        type: "error",
        timer: 2000
    });
}

function notificationMessage(title, body, color) {
    new PNotify({
        title: title,
        text: body,
        addclass: color
    });
}

function optimal_loader(span_class, show_hide) {
    if (show_hide == 'show') {
        $(span_class).css('display', 'initial');
    } else {
        $(span_class).css('display', 'none');
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////
//                              End Of Common Functions                                     //
//////////////////////////////////////////////////////////////////////////////////////////////
var add_button = false;
var renew_button = false;
$(document).on('click', '#add-button', function () {
    add_button = true;
    renew_button = false;
});
$(document).on('click', '#renew-button', function () {
    add_button = false;
    renew_button = true;
});

var base_url = 'http://' + window.location.host + '/';
$(function () {
    var base_url = 'http://' + window.location.host + '/';


    $(document).on('change', '.product_section_manage', function () {
        if ($(this).val() == 0) {
            $(this).parent().parent().parent().parent().find('.restaurant_section').removeClass('hide');
            $(this).parent().parent().parent().parent().find('.restaurant_section').addClass('show');
        } else {
            $(this).parent().parent().parent().parent().find('.restaurant_section').removeClass('show');
            $(this).parent().parent().parent().parent().find('.restaurant_section').addClass('hide');
        }
        $(this).parent().parent().parent().parent().find('#product_rest').val('').select2();
        return false;
    });


    $(document).on('submit', '#settings_submit_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'address', true, "#settings_submit_form");
                if (add_button)
                    notificationMessage('رسالة نجاح', 'تم تحديث الاعدادات بنجاح!', 'bg-success');


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                notificationMessage('رسالة خطأ', 'يوجد خطأ في بعض المدخلات', 'bg-danger');
                var errors = data.responseJSON;

                validation(errors, 'address', false, "#settings_submit_form");
            }

        });
        return false;

    });

    $(document).on('submit', '#sponsor_pay_submit_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'address', true, "#sponsor_pay_submit_form");
                if (add_button)
                    notificationMessage('رسالة نجاح', 'تم تسجيل دفع الكافل بنجاح!', 'bg-success');


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                notificationMessage('رسالة خطأ', 'يوجد خطأ في بعض المدخلات', 'bg-danger');
                var errors = data.responseJSON;

                validation(errors, 'address', false, "#sponsor_pay_submit_form");
            }

        });
        return false;

    });

    $(document).on('submit', '#profile_submit_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'address', true, "#profile_submit_form");
                if (add_button)
                    notificationMessage('رسالة نجاح', 'تم تحديث بيانات المستخدم بنجاح!', 'bg-success');


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                notificationMessage('رسالة خطأ', 'يوجد خطأ في بعض المدخلات', 'bg-danger');
                var errors = data.responseJSON;

                validation(errors, 'address', false, "#profile_submit_form");
            }

        });
        return false;

    });

    $(document).on('submit', '.user_update_form', function () {
        var this_form = $(this);
        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'address', true, "#user_update_form");
                notificationMessage('رسالة نجاح', 'تم تحديث بيانات المستخدم بنجاح!', 'bg-success');

                var gender = this_form.find("#gender option:selected").html();
                var submitted = this_form.find("#submitted_age option:selected").html();
                var country1 = this_form.find("#country1 option:selected").html();
                var state = this_form.find("#state option:selected").html();
                var injection_state = this_form.find("#injection_state option:selected").html();

                this_form.parent().parent().parent().prev().find('.name').text(data['data'].name);
                this_form.parent().parent().parent().prev().find('.gender').text(gender);
                this_form.parent().parent().parent().prev().find('.submitted_age').text(submitted);
                this_form.parent().parent().parent().prev().find('.country').text(country1);
                this_form.parent().parent().parent().prev().find('.state').text(state);
                this_form.parent().parent().parent().prev().find('.injection_state').text(injection_state);
                this_form.parent().parent().parent().prev().find('.phone').text(data['data'].phone);

                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                notificationMessage('رسالة خطأ', 'يوجد خطأ في بعض المدخلات', 'bg-danger');
                var errors = data.responseJSON;

                validation(errors, 'address', false, "#user_update_form");
            }

        });
        return false;

    });


    $(document).on('click', '.accept-btn', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');
        var that = $(this);


        $.ajax({
            type: 'get',
            dataType: "json",
            url: navigate_to,
            data: [],
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                notificationMessage('رسالة نجاح', 'تمت العملية بنجاح!', 'bg-success');
                that.parent().parent().find('.status').text('accepted');
                that.parent().html('');

                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                notificationMessage('رسالة خطأ', 'يوجد خطأ في بعض المدخلات', 'bg-danger');
                var errors = data.responseJSON;

                validation(errors, 'address', false, "#profile_submit_form");
            }

        });
        return false;

    });

    $(document).on('click', '.reject-btn', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');
        var that = $(this);


        $.ajax({
            type: 'get',
            dataType: "json",
            url: navigate_to,
            data: [],
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                notificationMessage('رسالة نجاح', 'تمت العملية بنجاح!', 'bg-success');
                that.parent().parent().find('.status').text('rejected');
                that.parent().html('');

                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                notificationMessage('رسالة خطأ', 'يوجد خطأ في بعض المدخلات', 'bg-danger');
                var errors = data.responseJSON;

                validation(errors, 'address', false, "#profile_submit_form");
            }

        });
        return false;

    });


    $(document).on('click', '.accept-joining-btn', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route') + '?dietitian_id=' + $(this).parent().parent().find('#dietitian_id').val();
        var that = $(this);


        $.ajax({
            type: 'get',
            dataType: "json",
            url: navigate_to,
            data: [],
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                notificationMessage('رسالة نجاح', 'تمت العملية بنجاح!', 'bg-success');
                that.parent().parent().find('.status').text('accepted');
                that.parent().html('');

                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                notificationMessage('رسالة خطأ', 'يوجد خطأ في بعض المدخلات', 'bg-danger');
                var errors = data.responseJSON;

                validation(errors, 'address', false, "#profile_submit_form");
            }

        });
        return false;

    });


    $(document).on('click', '.reject-joining-btn', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');
        var that = $(this);


        $.ajax({
            type: 'get',
            dataType: "json",
            url: navigate_to,
            data: [],
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                notificationMessage('رسالة نجاح', 'تمت العملية بنجاح!', 'bg-success');
                that.parent().parent().find('.status').text('rejected');
                that.parent().html('');

                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                notificationMessage('رسالة خطأ', 'يوجد خطأ في بعض المدخلات', 'bg-danger');
                var errors = data.responseJSON;

                validation(errors, 'address', false, "#profile_submit_form");
            }

        });
        return false;

    });
    $(document).on('submit', '#partner_submit_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'image', true, "#partner_submit_form");
                if (add_button)
                    notificationMessage('رسالة نجاح', 'تم إضافة شريك نجاح جديد!', 'bg-success');


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');

                validation(errors, 'address', false, "#partner_submit_form");
            }

        });
        return false;

    });

    $(document).on('submit', '#orphan_submit_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'image', true, "#orphan_submit_form");
                if (add_button)
                    notificationMessage('رسالة نجاح', 'تم إضافة يتيم جديد!', 'bg-success');


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');

                validation(errors, 'address', false, "#orphan_submit_form");
            }

        });
        return false;

    });
    $(document).on('click', '.update-partner-btn', function () {
            //     $('#students-table .details-rows').addClass('hide-td');
            $(this).parent().parent().next().find('.input').css('display', 'none');
            // $('#students-table tr:odd').removeClass('selected-td-show');
            $(this).parent().parent().addClass('selected-td-show');
            if (button_clicked == 'show-details') {
                button_clicked = 'update-btn';
            } else {
                if ($(this).parent().parent().next().css('display') == 'table-row')
                    $(this).parent().parent().removeClass('selected-td-show');
                $(this).parent().parent().next().slideToggle(1);
            }
            button_clicked = 'update-btn';
            $(this).parent().parent().next().find('.input-hide').css('display', 'initial');
            $(this).parent().parent().next().find('.update-button').css('display', 'initial');
            $(this).parent().parent().next().find('.img-div').css('display', 'none');

            return false;
        }
    );
    $(document).on('click', '.update-application-btn', function () {
            //     $('#students-table .details-rows').addClass('hide-td');
            $(this).parent().parent().next().find('.input').css('display', 'none');
            // $('#students-table tr:odd').removeClass('selected-td-show');
            $(this).parent().parent().addClass('selected-td-show');
            if (button_clicked == 'show-details') {
                button_clicked = 'update-btn';
            } else {
                if ($(this).parent().parent().next().css('display') == 'table-row')
                    $(this).parent().parent().removeClass('selected-td-show');
                $(this).parent().parent().next().slideToggle(1);
            }
            button_clicked = 'update-btn';
            $(this).parent().parent().next().find('.input-hide').css('display', 'initial');
            $(this).parent().parent().next().find('.update-button').css('display', 'initial');
            $(this).parent().parent().next().find('.img-div').css('display', 'none');

            return false;
        }
    );
    $(document).on('click', '.update-orphan-btn', function () {
            //     $('#students-table .details-rows').addClass('hide-td');
            $(this).parent().parent().next().find('.input').css('display', 'none');
            // $('#students-table tr:odd').removeClass('selected-td-show');
            $(this).parent().parent().addClass('selected-td-show');
            if (button_clicked == 'show-details') {
                button_clicked = 'update-btn';
            } else {
                if ($(this).parent().parent().next().css('display') == 'table-row')
                    $(this).parent().parent().removeClass('selected-td-show');
                $(this).parent().parent().next().slideToggle(1);
            }
            button_clicked = 'update-btn';
            $(this).parent().parent().next().find('.input-hide').css('display', 'initial');
            $(this).parent().parent().next().find('.update-button').css('display', 'initial');
            $(this).parent().parent().next().find('.img-div').css('display', 'none');

            return false;
        }
    );
    $(document).on('click', '.show-orphan-btn', function () {
            var rows_to_show = $('.show_' + $(this).attr('RowId'));
            //     $('#students-table .details-rows').addClass('hide-td');
            $(this).parent().parent().next().find('.input').css('display', 'none');
            // $('#students-table tr:odd').removeClass('selected-td-show');
            $(this).parent().parent().addClass('selected-td-show');
            if (button_clicked == 'show-details') {
                button_clicked = 'update-btn';
            } else {
                if ($(this).parent().parent().next().css('display') == 'table-row')
                    $(this).parent().parent().removeClass('selected-td-show');
                rows_to_show.slideToggle(1);
            }
            button_clicked = 'update-btn';
            $(this).parent().parent().next().find('.input-hide').css('display', 'initial');
            $(this).parent().parent().next().find('.update-button').css('display', 'initial');
            $(this).parent().parent().next().find('.img-div').css('display', 'none');

            return false;
        }
    );
    $(document).on('click', '.show-sponsor-btn', function () {
            var rows_to_show = $('.show_' + $(this).attr('RowId'));
            //     $('#students-table .details-rows').addClass('hide-td');
            $(this).parent().parent().next().find('.input').css('display', 'none');
            // $('#students-table tr:odd').removeClass('selected-td-show');
            $(this).parent().parent().addClass('selected-td-show');
            if (button_clicked == 'show-details') {
                button_clicked = 'update-btn';
            } else {
                if ($(this).parent().parent().next().css('display') == 'table-row')
                    $(this).parent().parent().removeClass('selected-td-show');
                rows_to_show.slideToggle(1);
            }
            button_clicked = 'update-btn';
            $(this).parent().parent().next().find('.input-hide').css('display', 'initial');
            $(this).parent().parent().next().find('.update-button').css('display', 'initial');
            $(this).parent().parent().next().find('.img-div').css('display', 'none');

            return false;
        }
    );


    $(document).on('click', '.delete-btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف المستخدم بشكل نهائي.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "نعم, قم بالحذف",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: direct_to,
                        data: "",
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم الحذف!", "لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                table_row.parent().parent().next().remove();
                                table_row.parent().parent().remove();
                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });


    $(document).on('submit', '#orphan_submit_import_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'image', true, "#orphan_submit_import_form");
                if (add_button)
                    notificationMessage('رسالة نجاح', 'تم إستيراد ملف الاكسل بنجاح!', 'bg-success');


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');

                validation(errors, 'address', false, "#orphan_submit_import_form");
            }

        });
        return false;

    });
    $(document).on('submit', '#sponsor_submit_import_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'image', true, "#sponsor_submit_import_form");
                if (add_button)
                    notificationMessage('رسالة نجاح', 'تم إستيراد ملف الاكسل بنجاح!', 'bg-success');


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');

                validation(errors, 'address', false, "#sponsor_submit_import_form");
            }

        });
        return false;

    });
    $(document).on('submit', '#message_submit_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'image', true, "#message_submit_form");
                if (add_button) {
                    if (data['result'] === 'success') {
                        notificationMessage('رسالة نجاح', 'تم رسال الرسالة بنجاح!', 'bg-success');
                    } else {
                        notificationMessage('رسالة خطأ', data['message'], 'bg-warning');
                    }
                }


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');

                validation(errors, 'address', false, "#message_submit_form");
            }

        });
        return false;

    });
    $(document).on('submit', '#message_send_pay_submit_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'image', true, "#message_send_pay_submit_form");
                if (add_button) {
                    if (data['result'] === 'success') {
                        notificationMessage('رسالة نجاح', 'تم رسال الرسالة بنجاح!', 'bg-success');
                    } else {
                        notificationMessage('رسالة خطأ', data['message'], 'bg-warning');
                    }
                }


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');

                validation(errors, 'address', false, "#message_send_pay_submit_form");
            }

        });
        return false;

    });

    $(document).on('submit', '#orphan_sponsor_submit_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'image', true, "#orphan_sponsor_submit_form");
                if (add_button)
                    notificationMessage('رسالة نجاح', 'تمت عملية الاسناد بنجاح!', 'bg-success');


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');

                validation(errors, 'address', false, "#orphan_sponsor_submit_form");
            }

        });
        return false;

    });

    $(document).on('click', '.delete-orphan-btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف اليتيم بشكل نهائي.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "نعم, قم بالحذف",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: direct_to,
                        data: "",
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم الحذف!", "لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                table_row.parent().parent().next().remove();
                                table_row.parent().parent().remove();
                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });
    $(document).on('click', '.delete-post-btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف الخبر بشكل نهائي.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "نعم, قم بالحذف",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: direct_to,
                        data: "",
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم الحذف!", "لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                table_row.parent().parent().remove();
                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });
    $(document).on('click', '.publish-post-btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم نشر الخبر للكفلاء المعنين.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#3dc700",
                confirmButtonText: "نعم, قم بالنشر",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: direct_to,
                        data: "",
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم النشر!", "لقد قمت بنشر الخبر بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                table_row.parent().parent().find('.status_text').text('تم نشره');
                                table_row.parent().find('.cancel-post-btn').remove();
                                table_row.parent().find('.pay-post-btn').remove();
                                table_row.parent().find('.publish-post-btn').remove();
                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });
    $(document).on('click', '.pay-post-btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم تغيير حالة الخبر 'تم شراءه'.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#3dc700",
                confirmButtonText: "نعم, قم بالشراء",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: direct_to,
                        data: "",
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم الشراء!", "لقد قمت بشراء الخبر بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                table_row.parent().parent().find('.status_text').text('تم شراءه');
                                table_row.parent().find('.cancel-post-btn').remove();
                                table_row.parent().find('.pay-post-btn').remove();
                                table_row.parent().find('.publish-post-btn').remove();
                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });
    $(document).on('click', '.cancel-post-btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم إلغاء الخبر.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#3dc700",
                confirmButtonText: "نعم, قم بالإلغاء",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: direct_to,
                        data: "",
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم الإلغاء!", "لقد قمت بإلغاء الخبر بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                table_row.parent().parent().find('.status_text').text('تم إلغاءه');
                                table_row.parent().find('.pay-post-btn').remove();
                                table_row.parent().find('.publish-post-btn').remove();
                                table_row.parent().find('.cancel-post-btn').remove();
                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });
    $(document).on('click', '.reserve-post-btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم الحجز الأن.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#3dc700",
                confirmButtonText: "نعم, قم بالحجز",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: direct_to,
                        data: "",
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم الحجز بنجاح!", "لقد قمت بالحجز بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                table_row.parent().html('<span style="border-radius: 10px" class="btn btn-light   mb-5">تم حجزه</span>');
                                table_row.remove();

                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });
    $(document).on('click', '.delete-sponsor-multi-btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        var items = [];
        $('.delete_item').each(function () {
            if ($(this).prop('checked')) {
                items.push($(this).val());
            }
        });
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف المحدد بشكل نهائي.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "نعم, قم بالحذف",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'post',
                        dataType: "json",
                        url: direct_to,
                        headers: {
                            'X-CSRF-Token': $('#csrf-token-public').attr('content')
                        },
                        data: {items: items},
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم الحذف!", "لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                $('.delete_item').each(function () {
                                    if ($(this).prop('checked')) {
                                        $(this).parent().parent().next().remove();
                                        $(this).parent().parent().remove();
                                    }
                                });

                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });


    $(document).on('submit', '.orphan_update_form', function () {
        var this_form = $(this);
        var submit = $(this).find("button[type='submit'] > .loader");
        var direct_to = $(this).attr("route");
        loader(submit, true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: direct_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                this_form.parent().parent().parent().prev().find('.orphan_file_no').text(data['orphan'].orphan_file_no);
                this_form.parent().parent().parent().prev().find('.name').text(data['orphan'].name);
                this_form.parent().parent().parent().prev().find('.gender').text(data['orphan'].gender);
                this_form.parent().parent().parent().prev().find('.orphan_old_year').text(data['orphan'].orphan_old_year);
                this_form.parent().parent().parent().prev().find('.mother_name').text(data['orphan'].mother_name);
                var success = data.responseJSON;
                validation(success, 'name', true, '.orphan_update_form');

                notificationMessage('رسالة نجاح', 'تم تعديل اليتيم النجاح !', 'bg-success');
                loader(submit, false);// hide loader and un-disable button

            }, error: function (data) {
                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');
                validation(errors, 'name', false, '.orphan_update_form');

                loader(submit, false);// hide loader and un-disable button
            }

        });
        return false;

    });


    $(document).on('click', '.delete-sponsor-btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف الكفيل بشكل نهائي.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "نعم, قم بالحذف",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: direct_to,
                        data: "",
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم الحذف!", "لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                table_row.parent().parent().next().remove();
                                table_row.parent().parent().remove();
                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });


    $(document).on('click', '.delete-orphan-sponsor-btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف العلاقة بشكل نهائي.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "نعم, قم بالحذف",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: direct_to,
                        data: "",
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم الحذف!", "لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                // table_row.parent().parent().next().remove();
                                table_row.parent().parent().remove();
                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });

    $(document).on('click', '.show-item-info', function () {
        var info = JSON.parse($(this).attr('Info'));
        var names = JSON.parse($(this).attr('fieldNames'));
        var item_id = $(this).attr('ItemId');
        for (var i = 0; i < names.length; i++) {
            console.log(names[i]);
        }
        var cols = '';
        $.each(names, function (i, val) {
            $.each(info, function (ii, val_info) {
                if (i == ii) {
                    cols += '<label class="col-lg-3 ">\n' +
                        ' <span class="labels">' + val + ': </span>\n' +
                        ' <input type="text" name="sponsor_file_no"\n' +
                        ' class="sponsor_file_no form-control "\n' +
                        ' value="' + val_info + '"/>\n' +
                        ' </label>';
                }
            });
        });
        var formGroup = ' <tr class="item-'+item_id+' details-rows">\n' +
            ' <td colspan="8" class="custom-td-show" style="padding: 0px">\n' +
            ' <div style="padding: 20px">';
        formGroup+=' <form action="post"' +
            ' class="form-horizontal form-validate-jquery sponsor_update_form"\n' +
            ' enctype="multipart/form-data">';

        formGroup+=cols;
        formGroup+='</form></div></td></tr>';

        if($(this).parent().parent().next().hasClass('item-'+item_id)){
            $(this).parent().parent().next().remove();
        }else{
            $(this).parent().parent().after(formGroup);
        }

        return false;
    });
    $(document).on('submit', '#sponsor_submit_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');


        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'image', true, "#sponsor_submit_form");
                if (add_button)
                    notificationMessage('رسالة نجاح', 'تم إضافة كافل جديد!', 'bg-success');


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');

                validation(errors, 'address', false, "#sponsor_submit_form");
            }

        });
        return false;

    });

    $(document).on('click', '.send_message_manually_btn', function () {
        var table_row = $(this);
        var direct_to = $(this).attr('route');
        swal({
                title: "هل أنت متأكد من ارسال الرسالة؟",
                text: "سيتم ارسال الرسائل للمتاخرين من الكفلاء.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "rgb(65, 177, 69)",
                confirmButtonText: "نعم, قم بالارسال",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: direct_to,
                        data: '',
                        cache: "false",
                        contentType: false,
                        processData: false,
                        success: function (data) {

                            resultMessage("تم الارسال!", "لقد قمت بالارسال بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);

                        }, error: function (data) {

                        }

                    });


                } else {
                    cancelDelete();
                }
            });
        return false;
    });

    // $(document).on('click', '.send_message_manually_btn', function() {
    //
    //     var submit = $(this).find(".loader");
    //     var icon_loader = $(this).find(".icon-loader");
    //     loader(submit,true);// show loader and disable button
    //     loader(icon_loader,false);// show loader and disable button
    //     var navigate_to = $(this).attr('route');
    //
    //
    //
    //     $.ajax({
    //         type: 'get',
    //         dataType: "json",
    //         url: navigate_to,
    //         data: '',
    //         cache: "false",
    //         contentType: false,
    //         processData: false,
    //         success: function(data) {
    //
    //             var success = data.responseJSON;
    //             validation(success,'image',true,"#sponsor_submit_form");
    //             if(data['flag']){
    //                 notificationMessage('رسالة نجاح','تم ارسال الرسائل!','bg-success') ;
    //                 loader(submit,false);
    //                 loader(icon_loader,true);
    //             }
    //
    //
    //
    //
    //
    //         },error:function(data){
    //
    //             loader(submit,false);// hide loader and un-disable button
    //             loader(icon_loader,true);
    //             console.log(data);
    //             var errors = data.responseJSON.message;
    //             notificationMessage('رسالة خطأ',errors,'bg-danger') ;
    //
    //             validation(errors,'address',false,"#sponsor_submit_form");
    //         }
    //
    //     });
    //     return false;
    //
    // });
    //

    $(document).on('submit', '.sponsor_update_form', function () {
        var this_form = $(this);
        var submit = $(this).find("button[type='submit'] > .loader");
        var direct_to = $(this).attr("route");
        loader(submit, true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: direct_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                this_form.parent().parent().parent().prev().find('.sponsor_file_no').text(data['sponsor'].sponsor_file_no);
                this_form.parent().parent().parent().prev().find('.name').text(data['sponsor'].name);
                this_form.parent().parent().parent().prev().find('.phone').text(data['sponsor'].phone);
                this_form.parent().parent().parent().prev().find('.sponsor_pay_end').text(data['sponsor'].sponsor_pay_end);
                this_form.parent().parent().parent().prev().find('.sponsor_pay_value').text(data['sponsor'].sponsor_pay_value);
                this_form.parent().parent().parent().prev().find('.ensure_type').text(data['sponsor'].ensure_type_text);
                this_form.parent().parent().parent().prev().find('.orphans_count').text(data['sponsor'].orphans_count);
                var success = data.responseJSON;
                validation(success, 'name', true, '.orphan_update_form');

                notificationMessage('رسالة نجاح', 'تم تعديل الكافل النجاح !', 'bg-success');
                loader(submit, false);// hide loader and un-disable button

            }, error: function (data) {
                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');
                validation(errors, 'name', false, '.orphan_update_form');

                loader(submit, false);// hide loader and un-disable button
            }

        });
        return false;

    });


    $(document).on('click', '.update-sponsor-btn', function () {
            //     $('#students-table .details-rows').addClass('hide-td');
            $(this).parent().parent().next().find('.input').css('display', 'none');
            // $('#students-table tr:odd').removeClass('selected-td-show');
            $(this).parent().parent().addClass('selected-td-show');
            if (button_clicked == 'show-details') {
                button_clicked = 'update-btn';
            } else {
                if ($(this).parent().parent().next().css('display') == 'table-row')
                    $(this).parent().parent().removeClass('selected-td-show');
                $(this).parent().parent().next().slideToggle(1);
            }
            button_clicked = 'update-btn';
            $(this).parent().parent().next().find('.input-hide').css('display', 'initial');
            $(this).parent().parent().next().find('.update-button').css('display', 'initial');
            $(this).parent().parent().next().find('.img-div').css('display', 'none');

            return false;
        }
    );


    $(document).on('click', '.undo-delete-student-btn', function () {
        var student_id = $(this).parent().find('.student_id').val();
        var table_row = $(this);
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم إستعادة جميع بيانات الطالب.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ffbd22",
                confirmButtonText: "نعم, قم بالإرجاع",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: base_url + 'students/' + student_id + '/undo_recycle',
                        data: "",
                        cache: "false",
                        success: function (data) {
                            if (data['result'] == 'success') {
                                resultMessage("تم الحذف!", "لقد قمت بالإرجاع بنجاح , ستغلق النافذة خلال 3 ثانية", "success", "#66BB6A", 3000);
                                table_row.parent().parent().next().remove();
                                table_row.parent().parent().remove();
                            }

                        }

                    });

                } else {
                    cancelDelete();
                }
            });
        return false;
    });

    $(document).on('keyup', '#student_name', function () {
        // var student_name = $(this).val() != '' ? $(this).val() : 'all';
        var student_name = $(this).val();
        if (student_name.length < 2) {
            $('.input-search').css('display', 'none');
            return false;
        }
        $('.input-search').css('display', 'initial');
        optimal_loader('.optimal-loader', 'show');
        $.ajax({
            type: 'get',
            dataType: "json",
            url: base_url + 'students/' + student_name + '/search/basic',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {
                optimal_loader('.optimal-loader', 'hide');
                if (data['count-students'] == 0) {
                    $('.input-search').css('display', 'none');
                    $('.no-match-record').css('display', 'block');
                    $('.input-search ul .record').remove();
                } else {
                    $('.input-search ul .record').remove();

                    $('.no-match-record').css('display', 'none');
                    $('.no-match-record').before(data['search-result']);
                }
            }, error: function (data) {


            }

        });
        return false;

    });
    $(document).mouseup(function (e) {
        var container = $(".input-search");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
    });
    $(document).on('click', '#student_name', function (e) {
        var container = $(".input-search");
        var has_items = $(".input-search ul .record").length;
        if (has_items < 1) {
            return false;
        }
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.show();
        }
    });

    $(document).on('click', '.record', function (e) {
        get_set('#student_id', $(this).find('.list-student-id'));
        get_set('#student_name', $(this).find('.list-student-name'));
        get_set('#student_address', $(this).find('.list-student-address'));
        get_set('#student_father_work', $(this).find('.list-student-father-work'));
        get_set('#student_age', $(this).find('.list-student-age'));
        get_set('.student_gender', $(this).find('.list-student-gender'));
        get_set('#student_phone', $(this).find('.list-student-phone'));
        get_set('#student_phone2', $(this).find('.list-student-phone2'));
        get_set('#student_school', $(this).find('.list-student-school'));
        get_set('#level_id', $(this).find('.list-student-level'));
        get_set('#branch_id', $(this).find('.list-student-branch'));
        if ($(this).find('.list-student-gender').val() == 'm') {
            $('.f_student_gender').parent().removeClass('checked');
            $('.m_student_gender').prop('checked', true);
            $('.m_student_gender').parent().addClass('checked');

            $('.student-gender > .gender').text('ذكر');
            $('.student-image').attr('src', base_url + 'images/ui/m_student.png');
        }
        if ($(this).find('.list-student-gender').val() == 'f') {
            $('.m_student_gender').parent().removeClass('checked');
            $('.f_student_gender').prop('checked', true);
            $('.f_student_gender').parent().addClass('checked');

            $('.student-gender > .gender').text('أنثى')
            $('.student-image').attr('src', base_url + 'images/ui/f_student.png');
        }

        //old date
        $('.old-reg-date').css('display', 'initial');
        $('.old-reg-date').text('تاريخ الاشتراك القديم: ' + $(this).find('.list-student-reg-date').val());
        //

        // student cart
        $('.student-name > .name').text($(this).find('.list-student-name').val());
        $('#level_id').change();
        //
        $('.input-search').css('display', 'none');
        $('#level_id').select2();
        $('#branch_id').select2();
        return false;

    });
    $(document).on('click', '#reset-button', function () {
            $('#student_submit_form').find(
                'input[name=student_name],input[name=student_address],input[name=student_father_work],input[name=student_age],input[name=student_school],input[name=student_phone],input[name=student_phone2],input[name=student_id]').val('');
            $('#level_id').val(1);
            $('#level_id').select2();
            $('#branch_id').select2();
            $('.old-reg-date').css('display', 'none');
            $('.old-reg-date').text('');
            $('.student-name > .name').text('طالب جديد');
            $('#level_id').change();
            return false;
        }
    );

    function get_set(set_for, get_from) {
        $(set_for).val($(get_from).val());
    }

    // $('.select-search').select2();


    $(document).on('keyup', '#student_name', function () {
        var student_name = $(this).val();
        $('.student-name > .name').text(student_name);
        return false;
    });
    $(document).on('change', '.student_gender', function () {
        var student_gender = $(this).val();
        if (student_gender == 'm') {
            $('.student-gender > .gender').text('ذكر');
            $('.student-image').attr('src', base_url + 'images/ui/m_student.png');
        }
        if (student_gender == 'f') {
            $('.student-gender > .gender').text('أنثى')
            $('.student-image').attr('src', base_url + 'images/ui/f_student.png');
        }
        ;

        $(this).prop('checked', true);

        return false;
    });

    $(document).on('change', '#level_id', function () {
        var student_level = $(this).find('option[value=' + $(this).val() + ']').text();
        $('.student-level > .level').text(student_level);
        return false;
    });

    var button_clicked = '';
    $(document).on('click', '.show-student-btn', function () {
            // $('#students-table .details-rows').addClass('hide-td');
            // $('#students-table .details-rows .input-hide').css('display','none');
            $(this).parent().parent().next().find('.input-hide').css('display', 'none');
            // $('#students-table tr:odd').removeClass('selected-td-show');


            $(this).parent().parent().addClass('selected-td-show');
            if (button_clicked == 'update-btn') {
                button_clicked = 'show-details';
            } else {
                if ($(this).parent().parent().next().css('display') == 'table-row')
                    $(this).parent().parent().removeClass('selected-td-show');
                $(this).parent().parent().next().slideToggle(1);
            }
            button_clicked = 'show-details';
            $(this).parent().parent().next().find('.input').css('display', 'initial');
            $(this).parent().parent().next().find('.img-div').css('display', 'initial');
            $(this).parent().parent().next().find('.update-button').css('display', 'none');
            return false;
        }
    );
    $(document).on('click', '.show-details', function () {
            // $('#students-table .details-rows').addClass('hide-td');
            // $('#students-table tr:odd').removeClass('selected-td-show');
            $(this).addClass('selected-td-show');
            if (button_clicked == 'update-btn') {
                button_clicked = 'show-details';
            } else {
                if ($(this).next().css('display') == 'table-row')
                    $(this).removeClass('selected-td-show');
                var request_id = $(this).find('.request_id').val();
                $('.request_' + request_id).slideToggle(1);

            }
            button_clicked = 'show-details';

            $(this).next().find('.input').css('display', 'initial');
            $(this).next().find('.input-hide').css('display', 'none');
            $(this).next().find('.update-button').css('display', 'none');
            $(this).next().find('.img-div').css('display', 'initial');

            return false;
        }
    );


    $(document).on('click', '.advanced-search-btn', function () {
            $('.show-advanced-search').slideToggle(1000);

            return false;
        }
    );


    $(document).on('submit', '#post_submit_form', function () {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit, true);// show loader and disable button
        var navigate_to = $(this).attr('route');
        var type = $(this).attr('method');
        var _token = $(this).find('input[name=_token]').val();


        $.ajax({
            type: type,
            dataType: "json",
            url: navigate_to,
            headers: {
                'X-CSRF-Token': _token
            },
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function (data) {

                var success = data.responseJSON;
                validation(success, 'image', true, "#post_submit_form");
                if (add_button)
                    notificationMessage('رسالة نجاح', 'تمت اضافة خبر جديد بنجاح!', 'bg-success');


                loader(submit, false);// hide loader and un-disable button
                $('#reset-button').click();

            }, error: function (data) {

                loader(submit, false);// hide loader and un-disable button

                var errors = data.responseJSON;
                notificationMessage('رسالة خطأ', errors.errors, 'bg-danger');

                validation(errors, 'address', false, "#post_submit_form");
            }

        });
        return false;

    });

});

