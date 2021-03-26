<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Policy;

class PolicyController extends Controller
{
    public function getListMenu()
    {
        $data = MenuGroup::all();
        return view('backend.menu.list-group', compact('data'));
    }

    public function getEditMenu($id)
    {
        $data = Menu::where('id_group', $id)->orderBy('position')->get();
        return view('backend.menu.menu-edit', compact('id', 'data'));
    }

    public function getListPolicy(){

        $data = Policy::where('type',1)->get();
        return view('backend.policy.list-policy',compact('data'));
    }

    public function addPolicy(){
        return view('backend.policy.add-policy');
    }

    public function postAddPolicy(Request $request){
        $this->validate($request,
            [
                'name'  => 'required',
                'content' => 'required',
                'slug'  => 'required',
            ],
            [
                'name.required'     => 'Tiêu đề không được để trống.',
                'content.required'    => 'Nội dung không được bỏ trống.',
                'slug.required'     => 'Đường dẫn tĩnh không được bỏ trống.',
            ]
        );

        $input = $request->all();

        //dd($input);

        $input['slug'] = $this->createSlug(str_slug($request->name));

        $input['status'] = $request->status == 1 ? 1 : null;

        $input['type'] = 1;

        $policy = Policy::create($input);

        flash('Thêm mới thành công.')->success();

        return redirect()->route('policy.list');
    }

    public function editPolicy($id){
        $data = Policy::find($id);
        return view('backend.policy.edit-policy',compact('data'));
    }

    public function postEditPolicy(Request $request, $id){
        $this->validate($request,
            [
                'name'  => 'required',
                'content' => 'required',
                'slug'  => 'required',
            ],
            [
                'name.required'     => 'Tiêu đề không được để trống.',
                'content.required'    => 'Nội dung không được bỏ trống.',
                'slug.required'     => 'Đường dẫn tĩnh không được bỏ trống.',
            ]
        );

        $input = $request->all();
        
        $input['status'] = $request->status == 1 ? 1 : null;

        $policy = Policy::find($id)->update($input);

        flash('Cập nhật thành công.')->success();
        
        return redirect()->back();
    }


    public function getAjaxSlug(Request $request)
    {
        $slug = str_slug($request->slug);
        $id = $request->id;
        $post = Policy::find($id);
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
            $count = Policy::where('id', '!=', $id)->where('slug', $slug)->count();
            return $count > 0;
        }else{
            $count = Policy::where('slug', $slug)->count();
            return $count > 0;
        }
    }

    public function deletePolicy($id){
        Policy::destroy($id);

        flash('Xóa thành công.')->success();

        return redirect()->back();
    }


    public function getListFooterContact(){

        $data = Policy::where('type',2)->orderBy('stt','ASC')->get();
        return view('backend.policy.list-ft-ct',compact('data'));
    }

    public function addFooterContact(){
        return view('backend.policy.add-ftct');
    }

    public function postAddFooterContact(Request $request){
        $this->validate($request,
            [
                'name'  => 'required',
                'content' => 'required',
                'slug'  => 'required',
            ],
            [
                'name.required'     => 'Tiêu đề không được để trống.',
                'content.required'    => 'Nội dung không được bỏ trống.',
                'slug.required'     => 'Đường dẫn tĩnh không được bỏ trống.',
            ]
        );

        $input = $request->all();

        $input['slug'] = $this->createSlug(str_slug($request->name));

        $input['status'] = $request->status == 1 ? 1 : null;

        $input['content'] = !empty($request->content) ? json_encode($request->content) : null;

        $input['type'] = 2;

        $policy = Policy::create($input);

        flash('Thêm mới thành công.')->success();

        return redirect()->route('policy.list-ftct');
    }

    public function editFooterContact($id){
        $data = Policy::find($id);
        $content = json_decode(@$data->content);
        return view('backend.policy.edit-ft-ct',compact('data','content'));
    }

    public function postEditFooterContact(Request $request, $id){
        $this->validate($request,
            [
                'name'  => 'required',
                'content' => 'required',
                'slug'  => 'required',
            ],
            [
                'name.required'     => 'Tiêu đề không được để trống.',
                'content.required'    => 'Nội dung không được bỏ trống.',
                'slug.required'     => 'Đường dẫn tĩnh không được bỏ trống.',
            ]
        );

        $input = $request->all();

        $input['status'] = $request->status == 1 ? 1 : null;

        $input['content'] = !empty($request->content) ? json_encode($request->content) : null;

        $policy = Policy::find($id)->update($input);


        flash('Cập nhật thành công.')->success();
        
        return redirect()->back();
    }

    public function deleteFooterContact($id){

        Policy::destroy($id);

        flash('Xóa thành công.')->success();

        return redirect()->back();
        
    }
}
