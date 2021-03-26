@extends('backend.layouts.app')
@section('controller','')
@section('controller_route', route('backend.home'))
@section('action','')
@section('content')
    <div class="content">
		

		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary">
		            <div class="box-body">
		            	<div class="table-translate">
					        <table class="table table-hover">
					            <thead>
					                <tr>
					                    <th width="30px">STT</th>
					                    <th width="">Tên trang</th>
					                    <th width="">Liên kết</th>
					                </tr>
					            </thead>
					            <tbody class="table-body-pro">
					                @foreach ($dataPages as $item)
					                    <tr>
					                        <td>{{ $loop->index + 1 }}</td>
					                        <td>{{ $item->name_page }}</td>
					                        <td>
					                            @if (\Route::has($item->route))
					                                <a href="{{ route($item->route) }}" target="_blank">
					                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
					                                    Link: {{ route($item->route) }}
					                                </a>
					                            @else
					                            	---------------
					                            @endif
					                        </td>
					                    </tr>
					                @endforeach
					            </tbody>
					        </table>
					    </div>
		            </div>
		        </div>
	        </div>
		</div>
    </div>
@endsection
