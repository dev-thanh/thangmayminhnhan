<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
   	protected $table = 'policy';

   	protected $fillable = ['name','content','slug','url','position','status','image','type','stt','meta_title','meta_description','meta_keyword'];
    
}
