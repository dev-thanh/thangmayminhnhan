@extends('backend.layouts.app')
@section('controller','Email nhận tin khuyến mại')
@section('controller_route',route('get.list.mail-sale'))
@section('action','Danh sách')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')

                <form action="{!! route('contact.postMultiDel') !!}" method="POST">
                    <div class="col-sm-6">
                        
    			        <table id="example1" class="table table-bordered table-striped table-hover">
    			          	<thead>
    				          <tr>
    				            <th width="10px">STT</th>
    				            <th>Email đăng ký nhận tin khuyến mại</th>
                                <th>Thời gian gửi</th>
    				            <th width="100px">Thao tác</th>
    				          </tr>
    			          	</thead>
    				        <tbody>
                                @foreach(@$data as $k => $item)
    				                <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{format_datetime($item->created_at,'d/m/Y')}}</td>
                                        <td>
                                            <a onclick="return confirm('Bạn chắc chắn mún xóa?')" href="{{route('get.list.delete-mail-sale',['id'=>@$item->id])}}">

                                        <i class="fa fa-trash-o fa-fw"></i> Xóa

                                    </a>
                                        </td>
                                    </td>
                                @endforeach
    				        </tbody>
    			        </table>
                    </div>
			    </form>
            </div>
        </div>
    </div>
@stop
