@extends('backend.layouts.app')

@section('controller', $module['name'] )

@section('controller_route', route($module['module'].'.index'))

@section('action', 'Danh sách')

@section('content')

    <div class="content">

        <div class="clearfix"></div>

        <div class="box box-primary">

            <div class="box-body">

                @include('flash::message')

                <form action="{!! route($module['module'].'.postMultiDel') !!}" method="POST">

                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                    <div class="btnAdd">

                        <a href="{{ route($module['module'].'.create') }}">

                            <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm dịch vụ</fa>

                        </a>

                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')">

                            <i class="fa fa-trash-o"></i> Xóa

                        </button>

                    </div>

                    <!-- @include('backend.layouts.components.table') -->

                    <table id="table-ajax" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>hình ảnh</th>
                            <th>Tên dịch vụ</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

                </form>

            </div>

        </div>

    </div>

@stop



@section('scripts')

    <!-- <?php $url = route($module['module'].'.index'); ?>

    @include('backend.layouts.components.table-js-config', ['route'=> $url ]) -->

    <script>
        jQuery(document).ready(function ($) {
            var table = $('#table-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('services.index') !!}',
                    type: 'GET',
                    data: function (d) {
                      // read start date from the element
                      d.start_date = $('#startDate').val();
                      // read end date from the element
                      d.end_date = $('#endDate').val();
                      d.type = '{{request()->type=='gift' ? 'gift' : 'product'}}';
                      // d.code = $('#code').val();
                    }
                },
                // pageLength: 10,
                columns: [
                    {data: 'checkbox', name: 'checkbox'},
                    // {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    {data: 'image', name: 'image'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},

                ],
                

                'columnDefs': [{
                    'targets': [0, 1],
                    'orderable': false,
                    'searchable': false,
                }],
                language: {
                    "sProcessing": "Đang xử lý...",
                    "sLengthMenu": "Xem _MENU_ mục",
                    "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                    "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix": "",
                    "sSearch": "Tìm:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Đầu",
                        "sPrevious": "Trước",
                        "sNext": "Tiếp",
                        "sLast": "Cuối"
                    }
                }
            });

            //table.row(index).data(data).draw(false)
        });
    </script>

@endsection