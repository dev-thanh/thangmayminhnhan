<?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
<style type="text/css" media="screen">
	.pagination li{
		cursor: pointer;
	}
</style>
@if(count($data) > 0)
<div class="page__product-group">
	@foreach($data as $item)
    <div class="product">
        <div class="box">
            <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="avata" title="{{$item->name}}">
            <img class="avata__image" src="{{url('/')}}/{{$item->image}}" alt="{{$item->name}}">
            </a>
            <div class="product__content">
                <h3 class="product__title">
                    <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="product__link" title="{{$item->name}}">
                     	{{$item->name}}
                    </a>
                </h3>
                <div class="product__cost">
                    @if($item->sale_price !='')
                        <span class="text__through">{{ number_format($item->regular_price,0, '.', '.') }}đ</span>
                        <span class="price__red">
                        {{ number_format($item->sale_price,0, '.', '.') }}đ
                        </span>
                    @else
                    	<span class="price__red">{{ number_format($item->regular_price,0, '.', '.') }}đ</span>
                    @endif
                </div>
                <div class="text__right">
                    <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="link__view" title="Xem chi tiết">
                    Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="text__right">
    <ul class="pagination">
        <li class="prev page-pre"><a><span>&#10140;</span></a></li>

        @for($i = 0; $i < $data->lastpage(); $i++)
        <li class="@if($i+1==$curent_page) active @endif page-number" data-page="{{$i+1}}">
        	<a>{{$i+1}}</a>
        </li>
        @endfor
        
        <li class="next page-next" data-lastpage="{{$data->lastpage()}}"><a><span>&#10140;</span></a></li>
    </ul>
</div>
@else
	<div class="page__product" style="text-align: center;padding: 50px;background: #f2f2f2">
		Không tìm thấy sản phẩm nào phù hợp
	</div>
@endif
<script type="text/javascript">
	var base = $('input[name="base_url"]').val();

    function getAjaxProducts(param, html= true) {

        $('.loadingcover').show();

        $.ajax({

            url: base + '/filter-products?page='+param.page,

            type: 'GET',

            data: param,

        })

        .done(function(data) {

            console.log(data);

            $('.loadingcover').hide();


                $('.page__category-main').html(data);

        })

    }

    $('.page-number').click(function(event) {

    	var page = $(this).data('page');

        var min_price = $('.filter-price:checked').data('min');

        var max_price = $('.filter-price:checked').data('max');

        var bran_checked = $('.filter-brand:checked').val();

        var slug = $('input[name="get_slug"]').val();

        param = { 

            _token: $('meta[name="_token"]').attr('content'),

            min_price : min_price,

            max_price : max_price,

            bran_checked : bran_checked,

            slug : slug,

            page : page

        }

        getAjaxProducts(param);

    });

    $('.page-next').click(function(event) {

    	var curent_page = $('.pagination').find('li.active').data('page');

    	var last_page = $(this).data('lastpage');

    	if(curent_page == last_page){
    		return false;
    	}

    	var page = curent_page+1;

        var min_price = $('.filter-price:checked').data('min');

        var max_price = $('.filter-price:checked').data('max');

        var bran_checked = $('.filter-brand:checked').val();

        var slug = $('input[name="get_slug"]').val();

        param = { 

            _token: $('meta[name="_token"]').attr('content'),

            min_price : min_price,

            max_price : max_price,

            bran_checked : bran_checked,

            slug : slug,

            page : page

        }

        getAjaxProducts(param);

    });

    $('.page-pre').click(function(event) {

    	var curent_page = $('.pagination').find('li.active').data('page');

    	if(curent_page == 1){
    		return false;
    	}

    	var page = curent_page-1;

        var min_price = $('.filter-price:checked').data('min');

        var max_price = $('.filter-price:checked').data('max');

        var bran_checked = $('.filter-brand:checked').val();

        var slug = $('input[name="get_slug"]').val();

        param = { 

            _token: $('meta[name="_token"]').attr('content'),

            min_price : min_price,

            max_price : max_price,

            bran_checked : bran_checked,

            slug : slug,

            page : page

        }

        getAjaxProducts(param);

    });
</script>