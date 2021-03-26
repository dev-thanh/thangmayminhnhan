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
				            	<a href="#introduce" data-toggle="tab" aria-expanded="true">Nội dung</a>
				            </li>
							
							</li>
							
				        </ul>
					</div>
					<?php if(!empty($data->content)){                                             
						$content = json_decode($data->content);
					} ?>
				    <div class="tab-content">
						
						<div class="tab-pane" id="introduce">
							<div class="row">
								
								<!-- <div class="col-sm-12">
									<div class="form-group">
										<label for="">Nội dung</label>
										<textarea class="content" name="content[introduce][content]">{!! @$content->introduce->content !!}</textarea>
									</div>
								</div> -->
								<div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Mô tả dịch vụ</label>
                                            <textarea class="content" name="desc">{!! old('desc', @$data->desc) !!}</textarea>
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
									                    	<th>Nội dung khối giới thiệu</th>
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
									                    	@if (!empty($content->process))
									                    		@foreach ($content->process as $id => $val)
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
			           <button type="submit" class="btn btn-primary">Lưu lại</button>
			        </div>
				</form>
			</div>
		</div>
	</div>
@stop