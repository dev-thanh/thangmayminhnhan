
@extends('backend.layouts.app')
@section('controller', 'Danh sách dịch vụ')
@section('controller_route', route($module['module'].'.index',['type'=>request()->type]))
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
		                <ul class="nav nav-tabs">
		                    <li class="active">
		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin dịch vụ</a>
		                    </li>
		                    
							<li class="">
		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
		                    </li>
		                </ul>
		                <div class="tab-content">

		                    <div class="tab-pane active" id="activity">
		                    	<div class="row">
                                    <?php 
										$code = old('code', @$data->code);
		                    			if(empty($code)){
		                    				$code = generateRandomCode();
		                    			}
		                    		?>
		                    		<input type="hidden" name="type" value="{{request()->type =='gift' ? 'gift' : 'product'}}">
		                    		
		                    		<div class="col-sm-12">
		                    			<div class="form-group">
		                                    <label>Tên dịch vụ</label>
		                                    <input type="text" class="form-control" name="name" id="name" value="{!! old('name', @$data->name) !!}">
		                                </div>
		                                @if(isUpdate(@$module['action']))
			                                <div class="form-group" id="edit-slug-box">
			                                    @include('backend.services.permalink')
			                                </div>
		                                @endif
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Mô tả ngắn dịch vụ</label>
                                            <textarea class="form-control" name="desc">{!! old('desc', @$data->desc) !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Chi tiết dịch vụ</label>
                                            <textarea class="content" name="content_detail">{!! old('content_detail', @$data->content_detail) !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Nội dung cuối trang</label>
                                            <textarea class="content" name="content_footer">{!! old('content_footer', @$data->content_footer) !!}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Nội dung khối</label>
                                        </div>
                                        <div class="col-sm-12">
                                        	<div class="repeater" id="repeater">
								                <table class="table table-bordered table-hover process">
								                    <thead>
									                    <tr>
															<th style="width: 30px">STT</th>
									                    	<th>Hình ảnh đại diện khối</th>
									                    	<th>Nội dung khối</th>
									                    	<th></th>
									                    </tr>
								                	</thead>
								                    <tbody id="sortable">
								                    	@if(old('content'))
								                    		@foreach (old('content')['process'] as $id => $val)
																<tr>
																	<td class="index">{{ $index = $loop->index + 1  }}</td>
																	
																	<td>
																		<div class="image">
																			<div class="image__thumbnail">
																				<img src="{{ !empty(@$val['image']) ? url('/').@$val['image'] : __IMAGE_DEFAULT__ }}"  
																				data-init="{{ __IMAGE_DEFAULT__ }}">
																				<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
																				<i class="fa fa-times"></i></a>
																				<input type="hidden" value="{{ @$val['image'] }}" name="content[process][{{ $id }}][image]"  />
																				<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
																			</div>
																		</div>
																	</td>
																	<td>
																		<textarea class="content" name="content[process][{{$id}}][content]">{!! $val['content'] !!}</textarea>
																        
																    </td>
																    <td style="text-align: center;">
																        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
																            <i class="fa fa-minus"></i>
																        </a>
																    </td>
																</tr>
								                    		@endforeach
								                    	@else
									                    	@if (!empty($data->content))
									                    		@foreach (json_decode($data->content)->process as $id => $val)
																	<tr>
																		<td class="index">{{ $index = $loop->index + 1  }}</td>
																		
																		<td>
																			<div class="image">
																				<div class="image__thumbnail">
																					<img src="{{ !empty($val->image) ? url('/').$val->image : __IMAGE_DEFAULT__ }}"  
																					data-init="{{ __IMAGE_DEFAULT__ }}">
																					<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
																					<i class="fa fa-times"></i></a>
																					<input type="hidden" value="{{ @$val->image }}" name="content[process][{{ $id }}][image]"  />
																					<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
																				</div>
																			</div>
																		</td>
																		<td>
																			<textarea class="content" name="content[process][{{$id}}][content]">{!! $val->content !!}</textarea>
																	        
																	    </td>
																	    <td style="text-align: center;">
																	        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
																	            <i class="fa fa-minus"></i>
																	        </a>
																	    </td>
																	</tr>
									                    		@endforeach
									                    	@endif
								                    	@endif
													</tbody>
								                </table>
								                <div class="text-right">
								                    <button class="btn btn-primary" 
										            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'process', '.process')">Thêm
										            </button>
								                </div>
								            </div>
                                        </div>
                                    </div>
		                    	</div>
							</div>

							<div class="tab-pane" id="setting">
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
				                            {{ asset( 'dich-vu/'.$data->slug ) }}
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
		                    <h3 class="box-title">Đăng dịch vụ</h3>
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

							</div>
							
		                    <div class="form-group text-right">
		                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại dịch vụ</button>
		                    </div>
		                </div>
					</div>
                    
		            <div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Ảnh dịch vụ</h3>
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

		                <div class="box-header with-border">
		                    <h3 class="box-title">Banner</h3>
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
	<script>
		jQuery(document).ready(function($) {
			$('#btn-ok').click(function(event) {
		        var slug_new = $('#new-post-slug').val();
		        var name = $('#name').val();
		        $.ajax({
		        	url: '{{ route($module['module'].'.get-slug') }}',
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
	
@endsection

@section('css')
	<link rel="stylesheet" href="{{ url('public/backend/plugins/datetimepicker/bootstrap-timepicker.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
@endsection

