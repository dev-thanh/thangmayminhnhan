<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\PostCategory;
use DataTables;
use Carbon\Carbon;

class PostController extends Controller
{

    protected function module(){
        return [
            'name' => 'Tin tức',
            'module' => 'posts',
            'table' =>[
                
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tiêu đề tin tức', 
                    'with' => '',
                ],
               
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '200px',
                ],
            ]
        ];
    }


    protected function fields()
    {

        return [
            'name' => 'required',
            'image' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề tin tức không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh cho tin tức.', 
            'category.required' => "Bạn chưa chọn danh mục tin tức",
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $list_posts = Posts::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_posts)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' . $data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })->addColumn('name', function ($data) {
                        return $data->name.'<br><a href="' . route('home.news-single', $data->slug) . '" target="_black">
                        <i class="fa fa-hand-o-right" aria-hidden="true"></i> Link: 
                        ' . route('home.news-single', $data->slug) . '
                      </a>';
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>';
                    }
                    if ($data->show_home == 1) {
                        $show_home = '<br><span class="label label-success">Hiển thị trang chủ</span>';
                    }else{
                        $show_home = '';
                    }
                    if ($data->is_new == 1) {
                        $is_new = '<br><span class="label label-success">Tin tức mới nhất</span>';
                    }else{
                        $is_new = '';
                    }
                    return $status.$show_home.$is_new;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('posts.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('posts.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })->rawColumns(['checkbox', 'image', 'status', 'action', 'slug', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.list", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['module'] = $this->module();

        $data['categories'] = Categories::where('type','post_category')->get();

        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, $this->fields(), $this->messages());

        $input = $request->all();
        
        $input['status'] = $request->status == 1 ? 1 : null;

        $input['show_home'] = $request->show_home == 1 ? 1 : null;

        $input['is_new'] = $request->is_new == 1 ? 1 : null;

        $input['slug'] = $this->createSlug(str_slug($request->name));

        $input['more_image'] = !empty($request->gallery) ? json_encode($request->gallery) : null;

        $product = Posts::create($input);

        flash('Thêm mới thành công.')->success();

        return redirect()->route($this->module()['module'].'.edit', $product);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);

        $data['data'] = Posts::findOrFail($id);

        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $fields = $this->fields();

        $this->validate($request, $fields, $this->messages());

        $input = $request->all();

        $input['status'] = $request->status == 1 ? 1 : null;

        $input['show_home'] = $request->show_home == 1 ? 1 : null;
        
        $input['is_new'] = $request->is_new == 1 ? 1 : null;

        $input['more_image'] = !empty($request->gallery) ? json_encode($request->gallery) : null;

        $product = Posts::find($id)->update($input);

        flash('Cập nhật tin tức thành công.')->success();
        return back()->with('active_tab', $request->active_tab);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        flash('Xóa thành công.')->success();

        Posts::destroy($id);
        
        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Posts::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }


    public function getAjaxSlug(Request $request)
    {
        $slug = str_slug($request->slug);
        $id = $request->id;
        $post = Posts::find($id);
        $post->slug = $this->createSlug($slug, $id);
        $post->save();
        return $this->createSlug($slug, $id);
    }

    public function createSlug($slugPost, $id = null)
    {
        $slug = $slugPost;
        $index = 1;
        $baseSlug = $slug;
        while ($this->checkIfExistedSlug($slug, $id)) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = time();
        }

        return $slug;
    }


    public function checkIfExistedSlug($slug, $id = null)
    {
        if($id != null) {
            $count = Posts::where('id', '!=', $id)->where('slug', $slug)->count();
            return $count > 0;
        }else{
            $count = Posts::where('slug', $slug)->count();
            return $count > 0;
        }
    }
}
