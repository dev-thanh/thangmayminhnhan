@extends('backend.layouts.app') 

@section('controller','Chính sách quy định')

@section('controller_route', route('policy.list'))

@section('action','Thêm mới')

@section('content')

	<div class="content">

		<div class="clearfix"></div>

        <div class="box box-primary">

            <div class="box-body">

               	@include('flash::message')

				<div class="row">

			        <div class="col-sm-12">

			            <div class="row">
			            	<form action="{{route('policy.post-add')}}" method="POST" >
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

						                                    <input type="text" class="form-control" name="name" id="name" value="{!! old('name') !!}" >

						                                </div>

						                                <div class="form-group" style="display: none;">

						                                    <label>Đường dẫn tĩnh</label>

						                                    <input type="text" class="form-control" name="slug" id="slug" value="{!! old('slug') !!}">

						                                </div>


						                                <div class="form-group">

						                                    <label>Nội dung</label>

						                                    <textarea class="content" name="content">{!! old('content') !!}</textarea>

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

						                            <input type="checkbox" name="status" value="1" checked=""> Hiển thị

						                        </label>

						                    </div>

						                    <div class="form-group text-right">

						                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>

						                    </div>

						                </div>

						            </div>

						            <div class="box box-success">

						                <div class="box-header with-border">

						                    <h3 class="box-title">Hình ảnh banner</h3>

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

@section('scripts')

    <script>

        jQuery(document).ready(function($) {

            var updateOutput = function(e){

                var list   = e.length ? e : $(e.target),

                    output = list.data('output');

                if (window.JSON) {

                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));

                    var param = window.JSON.stringify(list.nestable('serialize'));

                    $.ajax({

                        url: '{{ route('setting.menu.update') }}',

                        type: 'POST',

                        data: {

                            _token : $('#token').val(),

                            jsonMenu: param

                        },

                    }).done(function() {

                            $.toast({

                            text: "Cập nhật thành công !",

                            heading: 'Thông báo',

                            icon: 'success',

                            showHideTransition: 'fade',

                            allowToastClose: true, // Boolean value true or false

                            hideAfter: 1000, 

                            stack: 5, 

                            position: 'top-right', 

                            textAlign: 'left',

                            loader: true,

                            loaderBg: '#9ec600',

                        });

                    })

                } else {

                    output.val('JSON browser support required for this demo.');

                }

            };

            $('#nestable').nestable({

                group: 3,

                maxDepth : 3

            }).on('change', updateOutput);

            updateOutput($('#nestable').data('output', $('#nestable-output')));

        });

        

    </script>

@endsection



