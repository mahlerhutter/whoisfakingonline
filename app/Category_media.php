<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category_media extends Model
{
    
	protected $fillable = [
       
          
            'category_id','media_id'
  
    ];

      public function media(){

        return $this->hasMany('App\Media');
    }
    
         public function category(){

        return $this->hasMany('App\Category');
    }
}

