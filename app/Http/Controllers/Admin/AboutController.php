<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;
use DB;

class AboutController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAbout()
    {
        $data = About::first();
        return view('backend.about.create', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postAbout(Request $request)
    {
        $data = About::first();
        if (!$data) {
            $data = new About();
            $data->sort_desc = $request->sort_desc;
            $data->content = $request->content;
            $data->process = !empty($request->process) ? json_encode($request->process) : null;
            $data->vision_image = $request->vision_image;
            $data->vision = $request->vision;
            $data->mission_image = $request->mission_image;
            $data->mission = $request->mission;
            $data->save();
        }
        $data->sort_desc = $request->sort_desc;
        $data->content = $request->content;
        $data->process = !empty($request->process) ? json_encode($request->process) : null;
        $data->vision_image = $request->vision_image;
        $data->vision = $request->vision;
        $data->mission_image = $request->mission_image;
        $data->mission = $request->mission;
        $data->save();

        flash('Cập nhật thành công.')->success();
        return back();
    }
}