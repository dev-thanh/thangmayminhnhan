jQuery(document).ready(function($) {
    /*  GIỎ HÀNG  */
    ajax_giohang = function(id,qty,url,parent){
        $.ajax({
            url: url,
            type:'GET',
            data: {id:id,qty:qty},
            beforeSend: function() {
                
            },
            success: function(data) {
               console.log(data);
               parent.find('.cartitem-price').html(data.price_new);
               $('.total-cart').html(data.total);
               $('.count-cart').html('( '+data.count+' )');
               $('.disabled-click').removeClass();
            }
        });
    }
    $(".icon-minus-next").click(function(e){
        e.preventDefault();
        var parent = $(this).parents('tr');
        var id = parent.find('input[name="get_id_product"]').val();
        var url = parent.find('input[name="get_id_product"]').data('url');
        var qty_old = parent.find('input[name="product_qty"]');
        parent.addClass("disabled-click");
        var qty = qty_old.val();
        qty = parseFloat(qty)+1;
        qty_old.val(qty);

        ajax_giohang(id,qty,url,parent);
    });
    $(".icon-minus-pre").click(function(e){
        e.preventDefault();
        var parent = $(this).parents('tr');
        var id = parent.find('input[name="get_id_product"]').val();
        var url = parent.find('input[name="get_id_product"]').data('url');
        var qty_old = parent.find('input[name="product_qty"]');
        parent.addClass("disabled-click");
        var qty = qty_old.val();
        if(parseFloat(qty) > 1){
            qty =  parseFloat(qty)-1;        
            qty_old.val(qty);
            ajax_giohang(id,qty,url,parent);
        }
        else{
            //alert('Bạn có mún xóa sản phẩm khỏi giỏ hàng');
            $('.disabled-click').removeClass();
        }
    });

    $('.delete-cart').click(function(e){
        e.preventDefault();
        var _this_tbody = $(this).parents('tbody');
        var parent = $(this).parents('tr');
        var id = parent.find('input[name="get_id_product"]').val();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            type:'GET',
            data: {id:id},
            success: function(data) {
               console.log(data);
               $('.total-cart').html(data.total);
               $('.count-cart').html('( '+data.count+' )');
               toastr["success"](data.toastr, "");
               parent.remove();
               if(data.count==0){
                    _this_tbody.append('<tr><td colspan="5" rowspan="" headers="">'+data.empty+'</td></tr>');
               }
            }
        });
    });
    $('input[name="product_qty"]').blur(function(){
        var parent = $(this).parents('tr');
        var url = parent.find('input[name="get_id_product"]').data('url');
        var id = parent.find('input[name="get_id_product"]').val();
        var qty = $(this).val();
        if(qty !=''){            
            ajax_giohang(id,qty,url,parent);        
        }
    });

    $('#filter-products').click(function(e){
        var url = $('input[name="curent_url"]').val();
        var price_from = $('input[name="price_from"]').val();
        var price_to = $('input[name="price_to"]').val();
        location.href = url+'?min='+price_from+'&max='+price_to;
    });

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

                    $('#frm_contact')[0].reset();

                    toastr["success"](data.success, "Thông báo");

                }

                $('.loadingcover').hide();

            }

        });

    });

    $('.btn-send-sale').click(function(e){

        e.preventDefault();

        $('.loadingcover').show();

        var UrlContact =$('#form-send-sale').attr('action');

        var data = $("#form-send-sale").serialize();

        $.ajax({

            type: 'POST',

            url: UrlContact,

            dataType: "json",

            data: data,

            success:function(data){

                console.log(data);

                if(data.message_error){

                    toastr["error"](data.message_error, "Thông báo");

                }

                if (data.success) {

                    $('#form-send-sale')[0].reset();

                    toastr["success"](data.success, "Thông báo");

                }

                $('.loadingcover').hide();

            }

        });

    });

    var base = $('input[name="base_url"]').val();

    function getAjaxProducts(param, html= true) {

        $('.loadingcover').show();

        $.ajax({

            url: base + '/filter-products',

            type: 'GET',

            data: param,

        })

        .done(function(data) {

            console.log(data);

            $('.loadingcover').hide();


                $('.page__category-main-load').html(data);

        })

    }

    $('.filter-price').click(function(event) {

        var min_price = $(this).data('min');

        var max_price = $(this).data('max');

        var bran_checked = $('.filter-brand:checked').val();

        var order = $('.filter__top-radio:checked').val();

        var slug = $('input[name="get_slug"]').val();

        var search = $('input[name="url_search"]').val();

        param = { 

            _token: $('meta[name="_token"]').attr('content'),

            min_price : min_price,

            max_price : max_price,

            bran_checked : bran_checked,

            order : order,

            slug : slug,

            search : search,

        }

        getAjaxProducts(param);

    });

    $('.filter-brand').click(function(event) {

        var min_price = $('.filter-price:checked').data('min');

        var max_price = $('.filter-price:checked').data('max');

        var bran_checked = $(this).val();

        var order = $('.filter__top-radio:checked').val();

        var slug = $('input[name="get_slug"]').val();

        var search = $('input[name="url_search"]').val();

        param = { 

            _token: $('meta[name="_token"]').attr('content'),

            min_price : min_price,

            max_price : max_price,

            bran_checked : bran_checked,

            order : order,

            slug : slug,
            
            search : search,

        }

        getAjaxProducts(param);

    });

    $('.filter__top-radio').click(function(event) {

        var min_price = $('.filter-price:checked').data('min');

        var max_price = $('.filter-price:checked').data('max');

        var bran_checked = $('.filter-brand:checked').val();

        var order = $(this).val();

        console.log(order);

        var slug = $('input[name="get_slug"]').val();

        var search = $('input[name="url_search"]').val();

        param = { 

            _token: $('meta[name="_token"]').attr('content'),

            min_price : min_price,

            max_price : max_price,

            bran_checked : bran_checked,

            order : order,

            slug : slug,
            
            search : search,

        }

        getAjaxProducts(param);

    });
});