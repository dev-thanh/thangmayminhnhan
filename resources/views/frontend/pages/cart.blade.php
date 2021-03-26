@extends('frontend.master')
@section('main')

	<main id="main" class="main-category">
	    <section class="category__banner">
	        <img class="category__banner--img" src="{{url('/')}}/{{@$dataSeo->banner}}" alt="{{@$dataSeo->name_page}}">
	        <h2 class="category__banner--title">
	            {{@$dataSeo->name_page}}
	        </h2>
	    </section>
	    <article class="art-banners art-cart">
		    <div class="container">
		        <div class="row">
		            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
		                <div class="module module__cart module__contact module__pay">
		                    @if (Cart::count())
		                    <div class="module__content">
		                        <div class="div__form">
		                            <div class="content-table">
		                                <table class="table">
		                                    <thead>
		                                        <tr>
		                                            <th>Sản phẩm</th>
		                                            <th>Màu</th>
		                                            <th>Số lượng</th>
		                                            <th>Đơn giá</th>
		                                            <th>Thành tiền</th>
		                                            <th class="remove">Thao tác</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <?php $k=1; ?>
		                                        @foreach (Cart::content() as $item)
		                                        <tr>
		                                            <td class="product">
		                                                <div class="product__group">
		                                                    <img src="{{url('/').@$item->options->image}}" alt="{{$item->name}}">
		                                                    <a href="#" title="{{$item->name}}">{{$item->name}}</a>
		                                                </div>
		                                            </td>
		                                            <td>
		                                                {{App\Models\Order::getColor($item->options->color)}}
		                                            </td>
		                                            <td class="qty-number soluong">
		                                                <input type="hidden" name="get_id_product" data-url="{{route('home.update.cart')}}" value="{{$item->rowId}}">
		                                                <label class="icon-plus-number icon-minus icon-minus-pre">
		                                                <i class="fal fa-minus icon"></i>
		                                                </label>
		                                                <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" class="input-text qty text form-control" step="1"
		                                                    min="1" max="" name="product_qty" value="{{$item->qty}}" placeholder="">
		                                                <label class="icon-plus-number icon-plus icon-minus-next">
		                                                <i class="fal fa-plus icon"></i>
		                                                </label>
		                                            </td>
		                                            <td>
		                                                <span>{{ number_format($item->price, 0, '.', '.') }}đ</span>
		                                            </td>
		                                            <td>
		                                                <span class="cartitem-price">{{number_format($item->price*$item->qty, 0, '.', '.')}}đ</span>
		                                            </td>
		                                            <td class="remove">
		                                                <a href="{{route('home.remove.cart')}}" class="delete delete-cart">
		                                                    <i class="fas fa-trash-alt icon"></i>
		                                                </a>
		                                            </td>
		                                        </tr>
		                                        @endforeach
		                                    </tbody>
		                                    
		                                    <tfoot>
		                                        <tr>
		                                            <td colspan="4"></td>
		                                            <td>
		                                                <strong class="total-cart">
		                                                    Tổng đơn hàng: {{number_format(Cart::total(), 0, '.', '.')}}đ
		                                                </strong>
		                                            </td>
		                                        </tr>
		                                    </tfoot>
		                                </table>
		                            </div>


		                        </div>

		                    </div>
		                    @else
		                    <div class="module__content" style="text-align: center;background: 
		                    #d4edda;padding: 30px">
		                        Không có sản phẩm nào trong giỏ hàng
		                    </div>
		                    @endif
		                    <div class="row mt-3">
		                        <div class="col-12 col-lg-6">
		                            <div class="module__content">

		                                <div class="contacts-content">
		                                	<form action="{{ route('home.check-out.post') }}" method="POST" id="formsreviews" class="contacts-form">
	                            			@csrf
			                                    <div class="contacts-form">
			                                        <div class="module__header title-box">
			                                            <h3 class="title">Nhập thông tin</h3>
			                                        </div>

			                                        <div class="form-content">
			                                            <div class="form-group">
			                                                <input class="form-control" type="text" name="name" placeholder="Họ và tên">
		                                        			<span class="fr-error name_error"></span>
			                                            </div>
			                                            <div class="form-group">
			                                                <input class="form-control" type="text" name="phone" placeholder="Số điện thoại">
		                                            		<span class="fr-error phone_error"></span>
			                                            </div>
			                                            <div class="form-group">
			                                                <input class="form-control" type="text" name="address" placeholder="Địa chỉ">
		                                        			<span class="fr-error address_error"></span>
			                                            </div>
			                                        </div>



			                                        <div class="form-button">
			                                            <a class="btn" title="Tiếp tục mua hàng"
			                                                href="{{route('home.index')}}">Tiếp tục mua
			                                                hàng</a>
			                                            <button class="btn btn-check-out">
			                                                Thanh toán
			                                            </button>
			                                        </div>
			                                    </div>
			                                </form>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-12 col-lg-6">
		                            <div class="module__content">

		                                <div class="contacts-content">
		                                    <div class="contacts-form">
		                                        <div class="module__header title-box">
		                                            <h3 class="title">Hình thức thanh toán</h3>
		                                        </div>

		                                        <div class="form-content">
		                                            <div class="group__flex">
		                                                <label id="iDplay__1" for="play__1" class="flex__item">
		                                                    <input type="radio" id="play__1" name="type" value="1">
		                                                    <span>
		                                                        Thanh toán khi nhận hàng
		                                                    </span>
		                                                </label>
		                                                <label id="iDplay__2" for="play__2" class="flex__item">
		                                                    <input type="radio" name="type" value="2" id="play__2" checked>
		                                                    <span>
		                                                        Chuyển khoản ngân hàng
		                                                    </span>
		                                                </label>
		                                            </div>
		                                            <div class="form__bank">
		                                                <div class="bs-tab">
		                                                    <div class="tab-container">
		                                                        <div class="tab-control">
		                                                        	@if(count($banks) > 0)
		                                                            <ul class="control-list">
		                                                            	 @foreach(@$banks as $k => $item)
		                                                                <li class="control-list__item @if($k==0) active @endif" tab-show="#tab{{$k+1}}">
		                                                                    <img src="{{url('/').@$item->image}}" alt="{{@$item->name_bak}}">
		                                                                </li>
		                                                                @endforeach
		                                                            </ul>
		                                                            @endif
		                                                        </div>
		                                                        <div class="tab-content">
		                                                        	@foreach(@$banks as $k => $item)
		                                                            <div class="tab-item @if($k==0) active @endif" id="tab{{$k+1}}">
		                                                                <div class="bank__info">
		                                                                    <h3 class="bank__title">
		                                                                        Thông tin tài khoản
		                                                                    </h3>
		                                                                    <p>
		                                                                        Chủ tài khoản: {{@$item->name_account}}
		                                                                    </p>
		                                                                    <p>
		                                                                        Số tài khoản: {{@$item->bank_number}}
		                                                                    </p>
		                                                                    <p>
		                                                                        Chi nhánh: {{@$item->address}}
		                                                                    </p>
		                                                                </div>
		                                                            </div>
		                                                           @endforeach

		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		</article>
	</main>
	@section('script')
		<script type="text/javascript">
			$('.btn-check-out').click(function(e){
				e.preventDefault();

				$('.fr-error').html('');

				$('.loadingcover').show();

			    var Url =$('#formsreviews').attr('action');

			    var data = $("#formsreviews").serialize();

			    $.ajax({

			        type: 'POST',

			        url: Url,

			        dataType: "json",

			        data: data,

			        success: function(data) {

		                $('.loadingcover').hide();

		                if(data.success){

		                    toastr["success"](data.success, "");

		                    $('.box_content').html(data.html_response);

		                    $('.count-cart').html('0');

		                    $('#formsreviews')[0].reset();

		                }

		                if(data.error_cart_count){
		                	toastr["error"](data.error_cart_count, "Thông báo");
		                }

		                if(data.error.name){

		                    $('.name_error').html(data.error.name);

		                }

		                if(data.error.phone){

		                    $('.phone_error').html(data.error.phone);

		                }

		                if(data.error.address){

		                    $('.address_error').html(data.error.address);

		                }

		                if(data.error.note){

		                    $('.note_error').html(data.error.note);

		                }

                        if(data.status==3){
                            toastr["error"](data.error, "Thông báo");
                        }

		            },
		            error: function (jqXHR, exception) {
		                $('.loadingcover').hide();
		            }

			    });
			});
		</script>
	@endsection

@endsection