<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesCategory extends Model
{
    protected $table = 'services_category';
    protected $fillable = [ 
    	'id_category', 'id_services'
	];
}
