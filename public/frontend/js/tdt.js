jQuery(document).ready(function($) {

    $('.btn-send-contact').click(function(e){

        e.preventDefault();

        $('.loadingcover').show();

        var UrlContact =$('#frm_contact').attr('action');

        var data = $("#frm_contact").serialize();

        $.ajax({

            type: 'POST',

            url: UrlContact,

            dataType: "json",

            data: data,

            success:function(data){

                if(data.message_name){

                    $('.fr-error').css('display', 'block');

                    $('#error_name').html(data.message_name);

                } else {

                    $('#error_name').html('');

                }

                if(data.message_email){

                    $('.fr-error').css('display', 'block');

                    $('#error_email').html(data.message_email);

                } else {

                    $('#error_email').html('');

                }

                if(data.message_phone){

                    $('.fr-error').css('display', 'block');

                    $('#error_phone').html(data.message_phone);

                } else {

                    $('#error_phone').html('');

                }

                if(data.message_content){

                    $('.fr-error').css('display', 'block');

                    $('#error_content').html(data.message_content);

                } else {

                    $('#error_content').html('');

                }

                if (data.success) {

                    toastr["success"](data.success, "Thông báo");

                    $('#frm_contact')[0].reset();

                }

                $('.loadingcover').hide();

            }

        });

    });
});