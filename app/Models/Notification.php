<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
   	protected $table = 'notification';

   	protected $fillable = ['title','title_en','image','content','content_en','status','stt'];
    
}
