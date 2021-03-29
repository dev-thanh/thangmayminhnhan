<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Options;
use App\Models\Service;
use DateTime;
use SEO;
use SEOMeta;
use OpenGraph;
use App\Models\Menu;
use Illuminate\Support\Facades\Mail;
use App\Models\Image;
use JsValidator;
use Validator;
use DOMDocument;
use DB;
use Cart;
use App\Models\Services;
use App\Models\ServicesCategory;
use App\Models\Products;
use App\Models\Policy;
use App\Models\Contact;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\ProductCategory;
use App\Models\Accessories;
use App\Models\AccessoriesCategory;
use App\Models\Customer;



class IndexController extends Controller
{
    public $config_info;

    public function __construct()
    {
        $site_info = Options::where('type', 'general')->first();
        if ($site_info) {
            $site_info = json_decode($site_info->content);
            $this->config_info = $site_info;

            OpenGraph::setUrl(\URL::current());
            OpenGraph::addProperty('locale', 'vi');
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('author', 'GCO-GROUP');

            SEOMeta::addKeyword($site_info->site_keyword);

            $menuHeader = Menu::where('id_group', 1)->orderBy('position')->get();

            $policy = Policy::where('status', 1)->orderBy('stt','ASC')->get();

            view()->share(compact('site_info', 'menuHeader', 'policy'));
        }
    }

    public function createSeo($dataSeo = null)
    {
        $site_info = $this->config_info;
        if (!empty($dataSeo->meta_title)) {
            SEO::setTitle($dataSeo->meta_title);
        } else {
            SEO::setTitle($site_info->site_title);
        }
        if (!empty($dataSeo->meta_description)) {
            SEOMeta::setDescription($dataSeo->meta_description);
            OpenGraph::setDescription($dataSeo->meta_description);
        } else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
        }
        if (!empty($dataSeo->image)) {
            OpenGraph::addImage($dataSeo->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($site_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($dataSeo->meta_keyword)) {
            SEOMeta::addKeyword($dataSeo->meta_keyword);
        }
    }

    public function createSeoPost($data)
    {
        if(!empty($data->meta_title)){
            SEO::setTitle($data->meta_title);
        }else {
            SEO::setTitle($data->name);
        }
        if(!empty($data->meta_description)){
            SEOMeta::setDescription($data->meta_description);
            OpenGraph::setDescription($data->meta_description);
        }else {
            SEOMeta::setDescription($this->config_info->site_description);
            OpenGraph::setDescription($this->config_info->site_description);
        }
        if (!empty($data->image)) {
            OpenGraph::addImage($data->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($this->config_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($data->meta_keyword)) {
            SEOMeta::addKeyword($data->meta_keyword);
        }
    }

    public function getHome()
    { 
        $contentHome = Pages::where('type', 'home')->first();

        $this->createSeo($contentHome);

        $products_show = Products::where('status',1)->where('show_home', 1)->take(9)->get();

        $blogs = Posts::where('status', 1)->where('show_home',1)->orderBy('created_at','DESC')->take(5)->get();

        return view('frontend.pages.home', compact('contentHome', 'products_show', 'blogs'));
    }

    public function getListAbout(){

        $dataSeo = Pages::where('type', 'about')->first();

        $this->createSeo($dataSeo);

        return view('frontend.pages.about', compact('dataSeo'));
    }

    public function getServices(){


        $dataSeo = Pages::where('type', 'services')->first();

        $this->createSeo($dataSeo);

        $data = Services::where('status',1)->get();

        return view('frontend.pages.page-service',compact('data','dataSeo'));

    }

    public function servicesDetail($slug){

        $data = Services::where('slug',$slug)->where('status',1)->first();

        if(!isset($data)){
            return abort(404);
        }

        if($data->status!=1){
            return abort(404);
        }

        $dataSeo = Pages::where('type', 'services')->first();

        $this->createSeoPost($data);

        return view('frontend.pages.services-detail',compact('data','dataSeo'));

    }

    public function getSingleNews(Request $request, $slug)
    {
        $dataSeo = Pages::where('type', 'news')->first();

        $data = Posts::where('status', 1)->where('slug', $slug)->firstOrFail();

        if(!isset($data)){
            return abort(404);
        }

        $this->createSeoPost($data);

        $array_cate = $data->category()->get()->pluck('id')->toArray();
        

        $post_same_category = Posts::where([
            'status' => 1
        ])->orderBy('created_at', 'DESC')->get()->take(8);

        $post_new = Posts::where([
            'status' => 1,
            'is_new' => 1
        ])->orderBy('created_at', 'DESC')->get()->take(5);

        return view('frontend.pages.single-news', compact('dataSeo', 'data', 'post_new','post_same_category'));

    }


    public function getContact()
    {
        $dataSeo = Pages::where('type', 'contact')->first();

        $this->createSeo($dataSeo);

        return view('frontend.pages.contact', compact('dataSeo'));

    }

    public function postContact(Request $request)
    {
        $result = [];
        if ($request->name == '' || $request->name == null) {
            $result['message_name'] = 'Bạn chưa nhập họ tên';
        }
        
        if ($request->phone == '' || $request->phone == null) {
            $result['message_phone'] = 'Bạn chưa nhập số điện thoại';
        } else {
            if (!is_numeric($request->phone) || strlen($request->phone) != 10) {
                $result['message_phone'] = 'Vui lòng nhập đúng định dạng số điện thoại. Ví dụ: 0989888456';
            }
        }

        if($request->email !=''){
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $result['message_email'] = 'Địa chỉ email không hợp lệ';
            }
        }
        
        if (strlen($request->content) > 500) {
            $result['message_content'] = 'Nội dung không lớn hơn 500 ký tự';
        }
        if($result != []){
            return json_encode($result);
        }

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];
        
        $result['success'] = 'Gửi thông tin thành công, chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn !';

        $customer = Customer::create($data);

        $contact = new Contact;

        $contact->customer_id = $customer->id;

        $contact->type = $request->type;

        $contact->content = $request->content;

        $contact->status = 0;

        $contact->save();

        $content_email = [
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'content' => $request->content,
            'url' => route('contact.edit', $contact->id),
        ]; 

        $email_admin = getOptions('general', 'email_admin');

        Mail::send('frontend.mail.mail-teamplate', $content_email, function ($msg) use($email_admin) {

            $msg->from(config('mail.mail_from'), 'Website - Thang máy Minh Nhân');

            $msg->to($email_admin, 'Website - Thang máy Minh Nhân')->subject('Liên hệ từ khách hàng');

        });
        
        return json_encode($result);
    }

    public function getProducts(Request $request){

        $dataSeo = Pages::where('type', 'products')->first();

        $this->createSeo($dataSeo);

        $cateProducts = Categories::where('type','product_category')->get();

        $products = Products::where('status',1);

        $sort = $request->sort;

        switch ($sort) {
            case '':
                $data = $products->orderBy('created_at','DESC')->paginate(15);
                break;
            case 'moi-nhat':
                $data = $products->orderBy('created_at','DESC')->paginate(15);
                break;
            case 'cu-nhat':
                $data = $products->orderBy('created_at','ASC')->paginate(15);
                break;
            case 'a-z':
                $data = $products->orderBy('name','ASC')->paginate(15);
                break;
            case 'z-a':
                $data = $products->orderBy('name','DESC')->paginate(15);
                break;
        }

        return view('frontend.pages.products', compact('data', 'dataSeo','cateProducts'))->with('scroll','breadcrumb-box');
    }

    public function categoryProducts(Request $request, $slug){
        
        $cate = Categories::where('slug',$slug)->first();

        if(!isset($cate)){
            return abort(404);
        }

        $dataSeo = Pages::where('type', 'products')->first();

        $this->createSeoPost($cate);

        $cateProducts = Categories::where('type','product_category')->get();

        $sort = $request->sort;

        $page = $request->page;

        $products = ProductCategory::select('products.*')
                ->where('product_category.id_category',$cate->id)
                ->join('products','products.id','=','product_category.id_product');
        switch ($sort) {
            case '':
                $data =$products
                ->orderBy('created_at','DESC')
                ->paginate(15);
                break;
            case 'moi-nhat':
                $data =$products
                ->orderBy('created_at','DESC')
                ->paginate(15);
                break;
            case 'cu-nhat':
                $data =$products
                ->orderBy('created_at','ASC')
                ->paginate(15);
                break;
            case 'a-z':
                $data =$products
                ->orderBy('name','ASC')
                ->paginate(15);
                break;
            case 'z-a':
                $data =$products
                ->orderBy('name','DESC')
                ->paginate(15);
                break;
        }

        if($sort !='' || $page !=''){
            return view('frontend.pages.cate-products',compact('data','cate','slug','cateProducts'))->with('scroll','breadcrumb-box');
        }
        return view('frontend.pages.cate-products',compact('data','cate','slug','cateProducts','dataSeo'));
    }

    public function getSingleProduct($slug){

        $data = Products::where([
            'slug' => $slug,
            'status' => 1
        ])->firstOrFail();

        if(!isset($data)){
            return abort(404);
        }

        $cateProducts = Categories::where('type','product_category')->get();

        $dataSeo = Pages::where('type', 'products')->first();

        $this->createSeoPost($data);

        $list_category         = $data->category->pluck('id')->toArray();

        $list_post_related     = ProductCategory::whereIn('id_category', $list_category)->get()->pluck('id_product')->toArray();

        $product_same_category = Products::where('id', '!=', $data->id)->where('status', 1)->whereIn('id', $list_post_related)->orderBy('created_at', 'DESC')->take(15)->get();

        return view('frontend.pages.single-product', compact('data', 'dataSeo', 'product_same_category','cateProducts','list_category'));
    }

    public function getAccessories(Request $request){

        $dataSeo = Pages::where('type', 'accessories')->first();

        $this->createSeo($dataSeo);

        $cateAccessories = Categories::where('type','category_accessories')->get();

        $accessories = Accessories::where('status',1);

        $sort = $request->sort;

        switch ($sort) {
            case '':
                $data = $accessories->orderBy('created_at','DESC')->paginate(15);
                break;
            case 'moi-nhat':
                $data = $accessories->orderBy('created_at','DESC')->paginate(15);
                break;
            case 'cu-nhat':
                $data = $accessories->orderBy('created_at','ASC')->paginate(15);
                break;
            case 'a-z':
                $data = $accessories->orderBy('name','ASC')->paginate(15);
                break;
            case 'z-a':
                $data = $accessories->orderBy('name','DESC')->paginate(15);
                break;
        }

        return view('frontend.pages.accessories', compact('data', 'dataSeo','cateAccessories'))->with('scroll','breadcrumb-box');
    }

    public function categoryAccessories(Request $request, $slug){
        
        $cate = Categories::where('slug',$slug)->first();

        if(!isset($cate)){
            return abort(404);
        }

        $this->createSeoPost($cate);

        $dataSeo = Pages::where('type', 'products')->first();

        $cateAccessories = Categories::where('type','category_accessories')->get();

        $sort = $request->sort;

        $page = $request->page;

        $accessories = AccessoriesCategory::select('accessories.*')
                ->where('accessories_category.id_category',$cate->id)
                ->join('accessories','accessories.id','=','accessories_category.id_accessories');
        switch ($sort) {
            case '':
                $data =$accessories
                ->orderBy('created_at','DESC')
                ->paginate(15);
                break;
            case 'moi-nhat':
                $data =$accessories
                ->orderBy('created_at','DESC')
                ->paginate(15);
                break;
            case 'cu-nhat':
                $data =$accessories
                ->orderBy('created_at','ASC')
                ->paginate(15);
                break;
            case 'a-z':
                $data =$accessories
                ->orderBy('name','ASC')
                ->paginate(15);
                break;
            case 'z-a':
                $data =$accessories
                ->orderBy('name','DESC')
                ->paginate(15);
                break;
        }

        if($sort !='' || $page !=''){
            return view('frontend.pages.cate-accessories',compact('data','cate','slug','cateAccessories'))->with('scroll','breadcrumb-box');
        }
        return view('frontend.pages.cate-accessories',compact('data','cate','slug','cateAccessories','dataSeo'));
    }

    public function getSingleAccessories($slug){
        $data = Accessories::where([
            'slug' => $slug,
            'status' => 1
        ])->firstOrFail();

        if(!isset($data)){
            return abort(404);
        }

        $cateAccessories = Categories::where('type','category_accessories')->get();

        $dataSeo = Pages::where('type', 'accessories')->first();

        $this->createSeoPost($data);

        $list_category         = $data->category->pluck('id')->toArray();

        $list_post_related     = AccessoriesCategory::whereIn('id_category', $list_category)->get()->pluck('id_accessories')->toArray();

        $accessories_same_category = Accessories::where('id', '!=', $data->id)->where('status', 1)->whereIn('id', $list_post_related)->orderBy('created_at', 'DESC')->take(15)->get();

        return view('frontend.pages.single-accessories', compact('data', 'dataSeo', 'accessories_same_category','cateAccessories','list_category'));
    }


    public function getListNews()
    {
        $dataSeo = Pages::where('type', 'news')->first();

        $this->createSeo($dataSeo);

        $data = Posts::where('status', 1)->orderBy('created_at', 'DESC')->paginate(4);

        return view('frontend.pages.archives-news', compact('dataSeo', 'data'));
    }

    

    public function policy($slug){

        $data = Policy::where([
            'slug' =>$slug,
            'status' => 1
        ])->first();

        if(!isset($data)){
            return abort(404);
        }

        $this->createSeoPost($data);

        if($data){
            return view('frontend.pages.policy',compact('data'));
        }

    }

}
