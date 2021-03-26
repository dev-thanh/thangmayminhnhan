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
use App\Models\PostCategory;
use App\Models\Accessories;
use App\Models\AccessoriesCategory;

use App\Models\ProductAttributes;
use App\Models\ProductAttributeTypes;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Filter;
use App\Models\Banks;


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
        

        $post_same_category = PostCategory::select('posts.*')
        ->whereIn('post_category.id_category',$array_cate)
        ->join('posts','posts.id','=','post_category.id_post')
        ->where('posts.id','!=',$data->id)
        ->get()->take(5);

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

        $contact->title = $request->title;

        $contact->customer_id = $customer->id;

        $contact->type = $request->type;

        $contact->content = $request->content;

        $contact->status = 0;

        $contact->save();

        $content_email = [
            'title' => $title,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'type' => $request->type,
            'content' => $request->content,
            'url' => route('contact.edit', $contact->id),
        ]; 

        $email_admin = getOptions('general', 'email_admin');

        Mail::send('frontend.mail.mail-teamplate', $content_email, function ($msg) use($email_admin,$title) {

            $msg->from(config('mail.mail_from'), 'Website - Xe đạp điện Phong Lý');

            $msg->to($email_admin, 'Website - Xe đạp điện Phong Lý')->subject($title);

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
                $data = $products->orderBy('created_at','DESC')->paginate(12);
                break;
            case 'moi-nhat':
                $data = $products->orderBy('created_at','DESC')->paginate(12);
                break;
            case 'cu-nhat':
                $data = $products->orderBy('created_at','ASC')->paginate(12);
                break;
            case 'a-z':
                $data = $products->orderBy('name','ASC')->paginate(12);
                break;
            case 'z-a':
                $data = $products->orderBy('name','DESC')->paginate(12);
                break;
        }

        return view('frontend.pages.products', compact('data', 'dataSeo','cateProducts'))->with('scroll','breadcrumb-box');
    }

    public function categoryProducts(Request $request, $slug){
        
        $cate = Categories::where('slug',$slug)->first();

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
                ->paginate(12);
                break;
            case 'moi-nhat':
                $data =$products
                ->orderBy('created_at','DESC')
                ->paginate(12);
                break;
            case 'cu-nhat':
                $data =$products
                ->orderBy('created_at','ASC')
                ->paginate(12);
                break;
            case 'a-z':
                $data =$products
                ->orderBy('name','ASC')
                ->paginate(12);
                break;
            case 'z-a':
                $data =$products
                ->orderBy('name','DESC')
                ->paginate(12);
                break;
        }

        if($sort !='' || $page !=''){
            return view('frontend.pages.cate-products',compact('data','cate','slug','cateProducts'))->with('scroll','breadcrumb-box');
        }
        return view('frontend.pages.cate-products',compact('data','cate','slug','cateProducts'));
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

        $product_same_category = Products::where('id', '!=', $data->id)->where('status', 1)->whereIn('id', $list_post_related)->orderBy('created_at', 'DESC')->take(12)->get();

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
                $data = $accessories->orderBy('created_at','DESC')->paginate(12);
                break;
            case 'moi-nhat':
                $data = $accessories->orderBy('created_at','DESC')->paginate(12);
                break;
            case 'cu-nhat':
                $data = $accessories->orderBy('created_at','ASC')->paginate(12);
                break;
            case 'a-z':
                $data = $accessories->orderBy('name','ASC')->paginate(12);
                break;
            case 'z-a':
                $data = $accessories->orderBy('name','DESC')->paginate(12);
                break;
        }

        return view('frontend.pages.accessories', compact('data', 'dataSeo','cateAccessories'))->with('scroll','breadcrumb-box');
    }

    public function categoryAccessories(Request $request, $slug){
        
        $cate = Categories::where('slug',$slug)->first();

        $this->createSeoPost($cate);

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
                ->paginate(12);
                break;
            case 'moi-nhat':
                $data =$accessories
                ->orderBy('created_at','DESC')
                ->paginate(12);
                break;
            case 'cu-nhat':
                $data =$accessories
                ->orderBy('created_at','ASC')
                ->paginate(12);
                break;
            case 'a-z':
                $data =$accessories
                ->orderBy('name','ASC')
                ->paginate(12);
                break;
            case 'z-a':
                $data =$accessories
                ->orderBy('name','DESC')
                ->paginate(12);
                break;
        }

        if($sort !='' || $page !=''){
            return view('frontend.pages.cate-accessories',compact('data','cate','slug','cateAccessories'))->with('scroll','breadcrumb-box');
        }
        return view('frontend.pages.cate-accessories',compact('data','cate','slug','cateAccessories'));
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

        $accessories_same_category = Accessories::where('id', '!=', $data->id)->where('status', 1)->whereIn('id', $list_post_related)->orderBy('created_at', 'DESC')->take(12)->get();

        return view('frontend.pages.single-accessories', compact('data', 'dataSeo', 'accessories_same_category','cateAccessories','list_category'));
    }














    

    public function getArchiveProduct(Request $request, $slug){
        $dataSeo = Pages::where('type', 'product')->first();

        $category = Categories::where('slug', $slug)->firstOrFail();

        if(!isset($category)){
            return abort(404);
        }

        $this->createSeoPost($category);

        $data = ProductCategory::select('products.*')
            ->where('product_category.id_category',$category->id)
            ->join('products','products.id','=','product_category.id_product')
            ->where(function($q) use ($request) {
                if($request->min !=''){
                    $q->where('products.price_priority','>=',$request->min);
                    $q->where('products.price_priority','<=',$request->max);
                }
                if($request->bran_checked !=''){
                    $q->where('products.brand_id','=',$request->bran_checked);
                }
            })->orderBy('created_at','DESC')
            ->paginate(15);

        $parent  = getListParent(@$category);

        $filters = Filter::where('category_id',$parent->id)->get();

        return view('frontend.pages.products', compact('dataSeo', 'category', 'data','filters','slug'));
    }


    public function getFilterProductsAjax(Request $request){
        $category = Categories::where('slug',$request->slug)->first();

        if(isset($category)){
            $cate = $category;
        }else{
            $cate = '';
        }

        if($request->search){
            $products = Products::where(function($q) use ($request) {
                    if($request->min_price !=''){
                        $q->where('products.price_priority','>=',$request->min_price);
                        $q->where('products.price_priority','<=',$request->max_price);
                    }
                    if($request->bran_checked !=''){
                        $q->where('products.brand_id','=',$request->bran_checked);
                    }
                    if($request->search !=''){
                        $q->where('products.name', 'like', '%' . $request->search . '%');
                    }
                });
        }else{

            $products = ProductCategory::select('products.*')
                ->where('product_category.id_category',$category->id)
                ->join('products','products.id','=','product_category.id_product')
                ->where(function($q) use ($request) {
                    if($request->min_price !=''){
                        $q->where('products.price_priority','>=',$request->min_price);
                        $q->where('products.price_priority','<=',$request->max_price);
                    }
                    if($request->bran_checked !=''){
                        $q->where('products.brand_id','=',$request->bran_checked);
                    }
                });
        }

        $sort = $request->order;

        switch ($sort) {
            case '':
                $data =$products
                ->orderBy('created_at','DESC')
                ->paginate(20);
                break;
            case '1':
                $data =$products
                ->orderBy('products.price_priority','ASC')
                ->paginate(20);
                break;
            case '2':
                $data =$products
                ->orderBy('products.price_priority','DESC')
                ->paginate(20);
                break;
            case '3':
                $data =$products
                ->where('products.is_flash_sale',1)
                ->orderBy('created_at','DESC')
                ->paginate(20);
                break;
        }

        return view('frontend.pages.ajax-products', compact('category', 'data'));
    }

    public function getSearch(Request $request)
    {
        $key = $request->search;

        $dataSeo = Pages::where('type', 'product')->first();

        $this->createSeo($dataSeo);

        SEO::setTitle('Tìm kiếm từ khóa: '.$key);

        $data = Products::where(function ($query) use ($request) {
            if($request->min !=''){
                $query->where('products.price_priority','>=',$request->min);
                $query->where('products.price_priority','<=',$request->max);
            }
            $query->where('name', 'like', '%' . $request->search . '%');
        })->orderBy('created_at', 'DESC')->paginate(9);

        $filters = Filter::where('category_id',0)->get();

        return view('frontend.pages.products', compact('dataSeo', 'data','filters'));
    }

    /* Add Cart -- Check Out */

    public function postAddCart(Request $request)
    {
        $idProduct   = $request->id_product;
        
        $dataProduct = Products::findOrFail($idProduct);

        $dataCart    = [
            'id'      => $dataProduct->id,
            'name'    => $dataProduct->name,
            'color'    => $request->color,
            'qty'     => $request->qty,
            'price'   => $request->price,
            'weight'  => 0,
            'options' => [
                'image'       => $dataProduct->image,
                'slug'        => $dataProduct->slug,
                'attributes'  => !empty($request->input('attributes')) ? $request->input('attributes') : null,
                'gift'        => !empty($request->gift) ? $request->gift : null,
                'color'    => $request->color,
            ],
        ];

        Cart::add($dataCart);

        return redirect()->route('home.cart')->with(['toastr' => 'Thêm vào giỏ hàng thành công.']);
    }

    public function getAddCart(Request $request)
    {
        $idProduct   = $request->id;

        $dataProduct = Products::findOrFail($idProduct);

        $dataCart    = [
            'id'      => $dataProduct->id,
            'name'    => $dataProduct->name,
            'qty'     => 1,
            'price'   => !empty($dataProduct->price_sale) ? $dataProduct->price_sale : $dataProduct->price,
            'weight'  => 0,
            'options' => [
                'image'       => $dataProduct->image,
                'slug'        => $dataProduct->slug,
                'attributes'  => !empty($request->input('attributes')) ? $request->input('attributes') : null,
                'gift'        => !empty($request->gift) ? $request->gift : null,
            ],
        ];
        Cart::add($dataCart);
        return back()->with(['toastr' => 'Thêm vào giỏ hàng thành công.']);
    }

    public function getCart()
    {
        $dataSeo = Pages::where('type', 'cart')->first();

        $this->createSeo($dataSeo);

        $dataProducts = Products::orderBy('created_at','DESC')->take(12)->get();

        $banks = Banks::where('status',1)->get();

        return view('frontend.pages.cart', compact('dataProducts','dataSeo','banks'));
    }

    public function getRemoveCart(Request $request)
    {
        Cart::remove($request->id);
        $empty = '';
        
        $toastr = 'Xóa thành công sản phẩm ra khỏi giỏ hàng';
        if(Cart::count() ==0){
            $empty = 'Không có sản phẩm nào trong giỏ hàng';
        }
        
        return response()->json([
                'toastr' => $toastr,
                'total' => number_format(Cart::total(), 0, '.', '.').'đ',
                'count' => Cart::count(),
                'empty' => $empty,
        ]);
    }

    public function getUpdateCart(Request $request)
    {
        Cart::update($request->id, $request->qty);
        $item = Cart::get($request->id);
        $price_new = number_format($item->qty*$item->price, 0, '.', '.').'đ';
        return response()->json([
                'price_new'=>$price_new,
                'total' => 'Tổng đơn hàng: '.number_format(Cart::total(), 0, '.', '.').'đ',
                'count' => Cart::count()
        ]);
    }

    public function getCheckOut(){

        $dataSeo = Pages::where('type', 'cart')->first();

        $this->createSeo($dataSeo);

        return view('frontend.pages.checkout', compact('dataSeo'));
    }

    public function postCheckOut(Request $request)
    {
              
        $message = [
            'name.required' => 'Họ tên không được để trống.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.min' => 'Số điện thoại không hợp lệ.',
            'phone.max' => 'Số điện thoại không hợp lệ.',
            'address.required'     => 'Bạn chưa nhập địa chỉ',
            'address.max'          => 'Địa chỉ không thể lớn hơn 250 ký tự.',
            'note.max' => 'Nội dung không thể lớn hơn 300 ký tự.',
                
        ];

        $cart_count = Cart::count();

        if($cart_count==0){
            return response()->json([
                'status'=>3,
                'error' => 'Chưa có sản phẩm trong giỏ hàng!'
            ]);
        }
        
        $input = $request->all();

        if(Cart::count() == 0){
            return response()->json(['error_cart_count'=>'Giỏ hàng hiện đang trống!']); 
        }

        $validator = Validator::make($input, [
            'name' => 'required',
            'phone' => 'required| min:10|max:11',
            'address' => 'required|max:250',
            'note'        => 'max:300',
        ],$message);

        if ($validator->passes()) {
            $customer              = new Customer;
            $customer->name        = $request->name;
            $customer->phone       = $request->phone;
            $customer->address     = $request->address;
            $customer->save();
    
            $order                  = new Order;
            $order->id_customer     = $customer->id;
            $order->total_price     = Cart::total();
    
            $order->type            = $request->type;

            $order->status          = 1;
    
            $order->save();
    
            foreach (Cart::content() as $item) {
                $orderDetail                   = new OrderDetail;
                $orderDetail->id_order         = $order->id;
                $orderDetail->id_product       = $item->id;
                $orderDetail->qty              = $item->qty;
                $orderDetail->price            = $item->price;
                $orderDetail->color            = $item->options->color;
                $orderDetail->total            = $item->price * $item->qty;
                $orderDetail->save();
            }
    
            $dataMail = [
                'name'        => $request->name,
                'phone'       => $request->phone,
                'address'     => $request->address,
                'cart'        => Cart::content(),
                'total'       => Cart::total(),
            ];
    
            $email_admin = getOptions('general', 'email_admin');

            Mail::send('frontend.mail.mail-order', $dataMail, function ($msg) use($email_admin) {
                $msg->from(config('mail.mail_from'), 'Website - Xe đạp điện Phong Lý');
                $msg->to(@$email_admin, 'Website - Xe đạp điện Phong Lý')->subject('Thông báo đơn hàng mới');
            });
    
            Cart::destroy();
    
            $result['success'] = 'Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất.';

            $result['html_response'] = '<div class="contn"><div class="row"><div class="col-sm-12"><div class="alert alert-success" role="alert">Chưa có sản phẩm trong giỏ hàng.</div></div><div class="col-md-7 col-sm-7"><ul class="list-inline"><li class="list-inline-item"><div class="back-prd"><a title="Tiếp tục mua hàng" href="'.url('/').'"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a></div></li></ul></div></div></div>';
    
            return json_encode($result);
        }

        return response()->json(['error'=>$validator->errors()]);

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

    public function sendSale(Request $request){
        $result = [];
        
        if($request->email ==''){
            $result['message_error'] = 'Bạn chưa nhập email';
        }else{
            if(filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            }else{
                $result['message_error'] = 'Vui lòng nhập email hợp lệ';
            }
        }

        if($result != []){
            return json_encode($result);
        }

        $model = new PromotionalNews();

        $model->email = $request->email;

        $model->status = 0;

        $model->save();

        $content_email = [
            'email' => $request->email,
        ]; 

        $email_admin = getOptions('general', 'email_admin');

        Mail::send('frontend.mail.mail-sale', $content_email, function ($msg) use($email_admin) {

            $msg->from(config('mail.mail_from'), 'Website - Xe đạp điện Phong Lý');

            $msg->to($email_admin, 'Website - Xe đạp điện Phong Lý')->subject('Đăng ký nhận tin khuyến mại');

        });

        $result['success'] = 'Gửi đăng ký nhận tin khuyến mại thành công, chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn !';

        return json_encode($result);

    }

}
