@extends('backend.layouts.app')
@section('controller','Trang')
@section('controller_route',route('pages.list'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('pages.build.post') }}" method="POST">
					{{ csrf_field() }}
					<input name="type" value="{{ $data->type }}" type="hidden">

	               	<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Trang</label>
								<input type="text" class="form-control" value="{{ $data->name_page }}" disabled="">
				 				
								@if (\Route::has($data->route))
									<h5>
										<a href="{{ route($data->route) }}" target="_blank">
					                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
					                        Link: {{ route($data->route) }}
					                    </a>
									</h5>
				                @endif
							</div>
							
						</div>
					</div>
					<div class="nav-tabs-custom">
				        <ul class="nav nav-tabs">
				            <li class="active">
				            	<a href="#seo" data-toggle="tab" aria-expanded="true">Cấu hình trang</a>
				            </li>
				            <li class="">
				            	<a href="#content" data-toggle="tab" aria-expanded="true">Khối top</a>
				            </li>
				        </ul>
				    </div>
				    <?php if(!empty($data->content)){
							$content = json_decode($data->content);
							//dd(@$content);
						} ?>
				    <div class="tab-content">
			            <div class="tab-pane active" id="seo">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Hình ảnh</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->image ?  url('/').$data->image : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->image }}" name="image"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Banner</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->banner ?  url('/').$data->banner : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->banner }}" name="banner"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-8">
									<div class="form-group">
										<label for="">Tiêu đề trang</label>
										<input type="text" name="meta_title" class="form-control" value="{{ @$data->meta_title }}">
									</div>
									<div class="form-group">
										<label for="">Mô tả trang</label>
										<textarea name="meta_description" 
										class="form-control" rows="5">{!! @$data->meta_description !!}</textarea>
									</div>
									<div class="form-group">
										<label for="">Từ khóa</label>
										<input type="text" name="meta_keyword" class="form-control" value="{!! @$data->meta_keyword !!}">
									</div>
								</div>
							</div>
			            </div>
			            
			            <div class="tab-pane" id="content">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Tiêu đề header</label>
										<input type="text" name="content[title_header]" class="form-control" value="{{ @$content->title_header }}">
									</div>
									<div class="form-group">
										<label for="">Mô tả ngắn</label>
										<textarea name="content[meta_description]" 
										class="form-control content" rows="5">{!! @$content->meta_description !!}</textarea>
									</div>
									
								</div>
								<div class="col-sm-12">
									<div class="repeater" id="repeater">
						                <table class="table table-bordered table-hover top">
						                    <thead>
							                    <tr>
													<th style="width: 30px">STT</th>
							                    	<th>Icon</th>
							                    	<th>Nội dung</th>
							                    	<th></th>
							                    </tr>
						                	</thead>
						                    <tbody id="sortable">
						                    	@if (!empty($content->top))
						                    		@foreach ($content->top as $id => $val)
														<tr>
															<td class="index">{{ $index = $loop->index + 1  }}</td>
												
															<td>
																<textarea name="content[top][{{$id}}][html_icon]" class="form-control" rows="5">{{ @$val->html_icon }}</textarea>
															</td>
															<td>
														        <textarea name="content[top][{{$id}}][desc]" class="form-control" rows="5">{{ @$val->desc }}</textarea>
														    </td>
														    <td style="text-align: center;">
														        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
														            <i class="fa fa-minus"></i>
														        </a>
														    </td>
														</tr>
						                    		@endforeach
						                    	@endif
											</tbody>
						                </table>
						                <div class="text-right">
						                    <button class="btn btn-primary" 
								            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'top', '.top')">Thêm
								            </button>
						                </div>
						            </div>
								</div>
							</div>
						</div>

			           <button type="submit" class="btn btn-primary">Lưu lại</button>
			        </div>
				</form>
			</div>
		</div>
	</div>
@stop