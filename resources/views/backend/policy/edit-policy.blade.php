@extends('backend.layouts.app') 

@section('controller','Chính sách quy định')

@section('controller_route', route('policy.list'))

@section('action','Cập nhật')

@section('content')

	<div class="content">

		<div class="clearfix"></div>

        <div class="box box-primary">

            <div class="box-body">

               	@include('flash::message')

				<div class="row">

			        <div class="col-sm-12">

			            <div class="row">
			            	<form action="{{route('policy.post-edit',['id'=>$data->id])}}" method="POST" >
			            		@csrf
								<div class="col-sm-10">

						            <div class="nav-tabs-custom">

						                <ul class="nav nav-tabs">

						                    <li class="active">

						                        <a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin bài viết</a>

											</li>

						                </ul>

						                <div class="tab-content">

						                    <div class="tab-pane active" id="activity">

						                        <div class="row">

						                            <div class="col-sm-12">

						                                <div class="form-group">

						                                    <label>Tiêu đề</label>

						                                    <input type="text" class="form-control" name="name" id="name" value="{!! old('name',@$data->name) !!}" >

						                                </div>

						                                <div class="form-group" style="display: none;">

						                                    <label>Đường dẫn tĩnh</label>

						                                    <input type="text" class="form-control" name="slug" id="slug" value="{!! old('slug',@$data->slug) !!}">

						                                </div>


						                                <div class="form-group">

						                                    <label>Nội dung</label>

						                                    <textarea class="content" name="content">{!! old('content',@$data->content) !!}</textarea>

						                                </div>

						                            </div>

						                        </div>

											</div>

						                </div>

						            </div>

								</div>

								<div class="col-sm-2">

									<div class="box box-success">

						                <div class="box-header with-border">

						                    <h3 class="box-title">Đăng</h3>

						                </div>

						                <div class="box-body">

						                    <div class="form-group">

						                        <label class="custom-checkbox">

						                            <input type="checkbox" name="status" value="1" @if($data->status==1) checked @endif> Hiển thị

						                        </label>

						                    </div>

						                    <div class="form-group text-right">

						                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>

						                    </div>

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

								</div>
			            	</form>


						</div>

			        </div>

			    </div>

            </div>

        </div>

    </div>

@stop



