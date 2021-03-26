<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    
    protected $fillable = [ 'name','slug','parent_id','image','content', 'meta_title','meta_description', 'meta_keyword','type', 'banner', 'order','meta_banner','teamplate'];


    public function get_child_cate()
    {
        return $this->where('parent_id', $this->id)->orderBy('order')->get();
    }

    public function getParent()
    {
        return $this->where('id', $this->parent_id)->first();
    }

    public function Products()
    {
        return $this->belongsToMany('App\Models\Products', 'product_category', 'id_category', 'id_product');
    }

    public function Posts()
    {
        return $this->belongsToMany('App\Models\Posts', 'post_category', 'id_category', 'id_post');
    }

    public function Accessories()
    {
        return $this->belongsToMany('App\Models\Accessories', 'accessories_category', 'id_category', 'id_accessories');
    }

    
    public function Services()
    {
        return $this->belongsToMany('App\Models\Services', 'services_category', 'id_category', 'id_services');
    }

}
