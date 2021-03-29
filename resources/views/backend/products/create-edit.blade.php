@extends('backend.layouts.app')

@section('controller', $module['name'] )

@section('controller_route', route($module['module'].'.index'))

@section('action', renderAction(@$module['action']))

@section('content')

	<div class="content">

		<div class="clearfix"></div>

       	@include('flash::message')

       	<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">

			@csrf

			@if(isUpdate(@$module['action']))

		        {{ method_field('put') }}

		    @endif

			<div class="row">

				<div class="col-sm-9">

					<div class="nav-tabs-custom">
						<input type="hidden" name="active_tab" id="active_tab" value="">
		                <ul class="nav nav-tabs">

		                    <li class="@if(!session('active_tab') || session('active_tab')=='' || session('thong-tin')) active @endif" data-tab="thong-tin">

		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin</a>

		                    </li>

		                    <li  @if(session('active_tab')=='thu-vien-anh') class="active" @endif data-tab="thu-vien-anh">

		                    	<a href="#gallery" data-toggle="tab" aria-expanded="true">Thư viện ảnh</a>

		                    </li>

		                   

		                    <li  @if(session('active_tab')=='cau-hinh-seo') class="active" @endif data-tab="cau-hinh-seo">

		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>

		                    </li>

		                </ul>

		                <div class="tab-content">



		                    <div class="tab-pane  @if(!session('active_tab') || session('active_tab')=='' || session('active_tab')=='thong-tin') active @endif" id="activity">

		                    	<div class="row">

		                    		<?php 

		                    			$sku = old('sku', @$data->sku);

		                    			if(empty($sku)){

		                    				$sku = generateRandomCode();

		                    			}

		                    		?>

		                    		<div class="col-sm-12">

		                    			<div class="form-group">

				                    		<label for="">SKU</label>

				                    		<input type="text" name="sku" class="form-control" value="{{ @$sku }}">

				                    	</div>

		                    		</div>

		                    		<div class="col-sm-12">



		                    			<div class="form-group">

				                    		<label for="">Tên sản phẩm</label>

				                    		<input type="text" name="name" id="name" class="form-control" value="{{ old('name', @$data->name) }}">

				                    	</div>

										

										@if(isUpdate(@$module['action']))

			                                <div class="form-group" id="edit-slug-box">

			                                    @include('backend.products.permalink')

			                                </div>

		                                @endif



		                    		</div>

		                    		<div class="col-sm-12">

		                    			<div class="form-group">

		                    				<label for="">Chi tiết sản phẩm</label>

		                    				<textarea class="content" name="content">{!! old('content', @$data->content) !!}</textarea>

		                    			</div>

		                    		</div>
		                    	</div>

		                    </div>



		                    <div class="tab-pane @if(session('active_tab')=='thu-vien-anh') active @endif" id="gallery">

		                    	<div class="row">

			                        <div class="col-sm-12 image">

			                        	<label for="">Hình ảnh chi tiết sản phẩm</label><br>

			                            <button type="button" class="btn btn-success" onclick="fileMultiSelect(this)"><i class="fa fa-upload"></i>  

			                                Chọn hình ảnh

			                            </button>

			                            <br><br>

			                            <div class="image__gallery">

			                            	@if (!empty($data->more_image))

			                            		<?php $more_image = json_decode($data->more_image) ?>

			                            		@foreach ($more_image as $item)

			                            			<div class="image__thumbnail image__thumbnail--style-1">

			                            				<img src="{{ @$item }}">

			                            				<a href="javascript:void(0)" class="image__delete" onclick="urlFileMultiDelete(this)">

			                            					<i class="fa fa-times"></i>

			                            			    </a>

			                            				<input type="hidden" name="gallery[]" value="{{ @$item }}">

			                            			</div>

			                            		@endforeach

			                            	@endif

			                            </div>

			                        </div>

			                    </div>

		                    </div>

		                   
		                    <div class="tab-pane @if(session('active_tab')=='cau-hinh-seo') active @endif" id="setting">

		                    	<div class="form-group">

			                        <label>Title SEO</label>

			                        <label style="float: right;">Số ký tự đã dùng: <span id="countTitle">{{ @$data->meta_title != null ? mb_strlen( $data->meta_title, 'UTF-8') : 0 }}/70</span></label>

			                        <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', isset($data->meta_title) ? $data->meta_title : null) !!}" id="meta_title">

			                    </div>



			                    <div class="form-group">

			                        <label>Meta Description</label>

			                        <label style="float: right;">Số ký tự đã dùng: <span id="countMeta">{{ @$data->meta_description != null ? mb_strlen( $data->meta_description, 'UTF-8') : 0 }}/360</span></label>

			                        <textarea name="meta_description" class="form-control" id="meta_description" rows="3">{!! old('meta_description', isset($data->meta_description) ? $data->meta_description : null) !!}</textarea>

			                    </div>



			                    <div class="form-group">

			                        <label>Meta Keyword</label>

			                        <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', isset($data->meta_keyword) ? $data->meta_keyword : null) !!}">

			                    </div>

			                    @if(isUpdate(@$module['action']))

				                    <h4 class="ui-heading">Xem trước kết quả tìm kiếm</h4>

				                    <div class="google-preview">

				                        <span class="google__title"><span>{!! !empty($data->meta_title) ? $data->meta_title : @$data->name !!}</span></span>

				                        <div class="google__url">

				                            {{ asset( 'san-pham/'.$data->slug ) }}

				                        </div>

				                        <div class="google__description">{!! old('meta_description', isset($data->meta_description) ? @$data->meta_description : '') !!}</div>

				                    </div>

			                    @endif

		                    </div>

		                </div>

		            </div>

				</div>

				<div class="col-sm-3">

					<div class="box box-success">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Đăng sản phẩm</h3>

		                </div>

		                <div class="box-body">

		                    <div class="form-group">

		                        <label class="custom-checkbox">

		                        	@if(isUpdate(@$module['action']))

		                            	<input type="checkbox" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null }}> Hiển thị

		                            @else

		                            	<input type="checkbox" name="status" value="1" checked> Hiển thị

		                            @endif

		                        </label>

		                        <label class="custom-checkbox">

									@if(isUpdate(@$module['action']))

		                            	<input type="checkbox" name="show_home" value="1" {{ @$data->show_home == 1 ? 'checked' : null }}> Hiển thị trang chủ

		                            @else

		                            	<input type="checkbox" name="show_home" value="1"> Hiển thị trang chủ

		                            @endif

		                        </label>

		                    </div>

		                    <div class="form-group text-right">

		                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại sản phẩm</button>

		                    </div>

		                </div>

		            </div>

		            <div class="box box-success category-box">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Danh mục sản phẩm </h3>

		                </div>

		                <div class="box-body checkboxlist">

		                	<?php 

		                        $category_list = [];

		                        if(!empty(@$data->category)){

		                           $category_list = @$data->category->pluck('id')->toArray();

		                        }

		                    ?>

		                    @if (!empty($categories))

		                        @foreach ($categories as $item)

		                            @if ($item->parent_id == 0)

		                                <label class="custom-checkbox">

		                                    <input type="checkbox" class="category" name="category[]" value="{{ $item->id }}" {{ in_array( $item->id, $category_list ) ? 'checked' : null }}> {{ $item->name }}

		                                 </label>

		                                 <?php checkBoxCategory( $categories, $item->id, $item, $category_list ) ?>

		                            @endif

		                        @endforeach

		                    @endif

		                </div>

		            </div>

		            <div class="box box-success">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Ảnh sản phẩm</h3>

		                </div>

		                <div class="box-body">

		                    <div class="form-group" style="text-align: center;">

		                        <div class="image">

		                            @if(old('image'))
		                        	<div class="image__thumbnail">
		                                <img src="{{ !empty(old('image')) ? old('image') : __IMAGE_DEFAULT__ }}"
		                                     data-init="{{ __IMAGE_DEFAULT__ }}">
		                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
		                                    <i class="fa fa-times"></i></a>
		                                <input type="hidden" value="{{ old('image') }}" name="image"/>
		                                <div class="image__button" onclick="fileSelect(this)">
		                                	<i class="fa fa-upload"></i>
		                                    Upload
		                                </div>
		                            </div>
		                        	@else
		                            <div class="image__thumbnail">
		                                <img src="{{ !empty(@$data->image) ? @$data->image : __IMAGE_DEFAULT__ }}"
		                                     data-init="{{ __IMAGE_DEFAULT__ }}">
		                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
		                                    <i class="fa fa-times"></i></a>
		                                <input type="hidden" value="{{ old('image', @$data->image) }}" name="image"/>
		                                <div class="image__button" onclick="fileSelect(this)">
		                                	<i class="fa fa-upload"></i>
		                                    Upload
		                                </div>
		                            </div>
		                            @endif

		                        </div>

		                    </div>

		                </div>

		            </div>

		            <div class="box box-success">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Banner chi tiết sản phẩm</h3>

		                </div>

		                <div class="box-body">

		                    <div class="form-group" style="text-align: center;">

		                        <div class="image">
		                        	@if(old('banner'))
		                        	<div class="image__thumbnail">
		                                <img src="{{ !empty(old('banner')) ? old('banner') : __IMAGE_DEFAULT__ }}"
		                                     data-init="{{ __IMAGE_DEFAULT__ }}">
		                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
		                                    <i class="fa fa-times"></i></a>
		                                <input type="hidden" value="{{ old('banner') }}" name="banner"/>
		                                <div class="image__button" onclick="fileSelect(this)">
		                                	<i class="fa fa-upload"></i>
		                                    Upload
		                                </div>
		                            </div>
		                            
		                        	@else
		                            <div class="image__thumbnail">

		                                <img src="{{ !empty(@$data->banner) ? @$data->banner : __IMAGE_DEFAULT__ }}"

		                                     data-init="{{ __IMAGE_DEFAULT__ }}">

		                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">

		                                    <i class="fa fa-times"></i></a>

		                                <input type="hidden" value="{{ old('banner', @$data->banner) }}" name="banner"/>

		                                <div class="image__button" onclick="fileSelect(this)">

		                                	<i class="fa fa-upload"></i>

		                                    Upload

		                                </div>

		                            </div>
		                            @endif

		                        </div>

		                    </div>

		                </div>

		            </div>

				</div>

			</div>

		</form>

	</div>

@stop



@section('scripts')

	<script src="{{ url('public/backend/cus/select.option.js') }}"></script>
	<script src="{{ url('public/backend/plugins/datetimepicker/bootstrap-datepicker.min.js') }}"></script>

	

	<script>

		$(document).on('ready', function() {

		    $('.multislt').select2({

		        placeholder: "Chọn thương hiệu",

		    });

		});

	</script>

	<script>

		jQuery(document).ready(function($) {

			$('#btn-ok').click(function(event) {

		        var slug_new = $('#new-post-slug').val();

		        var name = $('#name').val();

		        $.ajax({

		        	url: '{{ route('products.get-slug') }}',

		        	type: 'GET',

		        	data: {

		        		id: $('#idPost').val(),

		        		slug : slug_new.length > 0 ? slug_new : name,

		        	},

		        })

		        .done(function(data) {

		        	$('#change_slug').show();

			        $('#btn-ok').hide();

			        $('.cancel.button-link').hide();

			        $('#current-slug').val(data);

		        	cancelInput(data);

		        })

		    });

		});	

	</script>

	<script>

		jQuery(document).ready(function($) {

			$('input[name="time_published"]').click(function(){

			   	if($(this).val() == 2){

			   		$('.time_published_value').show('slow/400/fast');

			   	}else{

			   		$('.time_published_value').hide('slow/400/fast');

			   	}

			});

			

			$('.nav-tabs-custom li').on('click',function(){
				console.log(22);
				var tab_name = $(this).data('tab');
				$('#active_tab').val(tab_name);
			})
		});

	</script>

@endsection