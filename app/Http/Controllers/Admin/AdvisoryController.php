<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Advisory;

class AdvisoryController extends Controller
{
    public function getListadvisory(Request $request)
    {
        if ($request->ajax()) {
            $data = Advisory::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('name', function ($data) {
                    return $data->name;
                })->addColumn('phone', function ($data) {
                    return $data->phone;
                })->addColumn('building_site', function ($data) {
                    return $data->building_site;
                })->addColumn('advisory_content', function ($data) {
                    return $data->advisory_content;
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Đã xem</span>';
                    } else {
                        $status = ' <span class="label label-danger">Chưa xem</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('advisory.edit', $data->id) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Xem
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('advisory.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>';
                })->rawColumns(['checkbox', 'type', 'phone', 'name', 'email', 'status', 'action', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('backend.advisory.list');
    } 

    public function postDeleteMuti(Request $request)
    {
        if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {
                Advisory::destroy($id);
            }
            flash('Xóa thành công !')->success();
            return redirect()->back();
        } else {
        	flash('Bạn chưa chọn dữ liệu cần xóa !')->error();
            return redirect()->back();
        }
    }

    public function getEdit($id)
    {
        $data = Advisory::findOrFail($id);
        if ($data->status == 0) {
            $data->status = 1;
            $data->save();
        }

        return view('backend.advisory.edit', compact('data'));
    }

    public function postEdit(Request $request, $id)
    {
        $contact = Advisory::find($id);
        if ($contact->status == 0) {
            $contact->status = $request->status == 1 ? 1 : 0;
            $contact->save();
        }
        flash('Cập nhật trạng thái thành công !')->success();
        return redirect()->route('get.list.contact');

    }

    public function getDelete($id)
    {
        Advisory::destroy($id);
        flash('Xóa thành công !')->success();
        return redirect()->back();
    }
}
