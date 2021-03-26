<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    protected $table = 'accessories';
    
    protected $fillable = ['sku', 'name', 'slug', 'image', 'sort_desc', 'content', 'show_home', 'status', 'meta_title', 'meta_description', 'meta_keyword', 'banner', 'more_image'
    ];

    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'accessories_category', 'id_accessories', 'id_category');
    }
}
