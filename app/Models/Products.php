<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trails\ModelScopes;

class Products extends Model
{
    use SoftDeletes, ModelScopes;
    protected $table = 'products';

    protected $dates = ['deleted_at'];

    protected $fillable = ['sku', 'name', 'slug', 'image', 'sort_desc', 'content', 'show_home', 'status', 'meta_title', 'meta_description', 'meta_keyword', 'banner', 'more_image'
    ];

    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'product_category', 'id_product', 'id_category');
    }


    public function scopeSort($query)
    {
        if (request('order')) {
            $order = request('order');
            $order = explode('-', $order);
            if($order[0] == 'price'){
                $query->orderBy('regular_price', $order[1]);
            }else{
                $query->where('is_selling', 1)->orderBy('is_selling', 'desc');
            }
        }else{
            $query->orderBy('created_at', 'desc');
        }
        return $query;
    }


    
    

}
