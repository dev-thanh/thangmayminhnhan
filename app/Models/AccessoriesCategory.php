<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessoriesCategory extends Model
{
    protected $table = 'accessories_category';
    protected $fillable = [ 
    	'id_category', 'id_accessories'
	];
}
