<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $fillable = [ 
        'name', 'slug' , 'desc' , 'content' , 'content_detail','content_footer', 'image' , 'banner', 'more_image' , 'stt', 'view', 'status' , 'meta_title' , 'meta_description' , 'meta_keyword', 'is_new', 'type','show_home'
	];

    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'services_category', 'id_services', 'id_category');
    }
}
