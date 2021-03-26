<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $fillable = [ 
    	'name', 'slug' , 'sort_desc' , 'content' , 'image' , 'banner', 'type' , 'show_home', 'is_new', 'status' , 'meta_title' , 'meta_description' , 'meta_keyword', 'user_id', 'view'
	];

	public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'post_category', 'id_post', 'id_category');
    }

	public function Author()
    {
        return $this->hasOne('App\User', 'id', 'user_id'); 
    }
}
