@extends('backend.layouts.app') 

@section('controller','Thông tin giới thiệu')

@section('controller_route', route('policy.list'))

@section('action','Danh sách')

@section('content')

	<div class="content">

		<div class="clearfix"></div>

        <div class="box box-primary">

            <div class="box-body">

               	@include('flash::message')

               	<div class="btnAdd">

		            <a href="{{route('policy.add')}}">

		                <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</fa>

		            </a>

		        </div>

				<table class="table table-bordered table-striped table-hover">

	            <thead>

		            <tr>

		                <th>STT</th>

		                <th>Tiêu đề</th>

		                <th>Trạng thái</th>

		                <th>Thao tác</th>

		            </tr>

	            </thead>

	            <tbody>

	                @foreach ($data as $item)

	                    <tr>

	                        <td>{{ $loop->index +1 }}</td>

	                        <td>
	                        	{{ $item->name }}<br>
	                        	<a href="{{route('home.policy',['slug'=>$item->slug])}}" target="_blank">{{route('home.policy',['slug'=>$item->slug])}}</a>
	                        </td>

	                        <td>
	                        	@if($item->status==1)
	                        		<span class="label label-success">Hiển thị</span>
	                        	@else
	                        		<span class="label label-danger">Đã ẩn</span>
	                        	@endif
	                        </td>

	                        <td>

	                            <a href="{{route('policy.edit',['id'=>@$item->id])}}">

	                                <i class="fa fa-pencil fa-fw"></i> Sửa

	                            </a>
	                            &nbsp
	                            <a onclick="return confirm('Bạn chắc chắn mún xóa?')" href="{{route('policy.delete',['id'=>@$item->id])}}">

	                                <i class="fa fa-trash-o fa-fw"></i> Xóa

	                            </a>

	                        </td>

	                    </tr>

	                @endforeach

	            </tbody>

	        </table>

            </div>

        </div>

    </div>

@stop

