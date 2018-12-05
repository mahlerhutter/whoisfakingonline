<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
	protected $fillable = [
       
          
            'name','added_by','is_active'
  
    ];

      public function media(){

        return $this->belongsToMany('App\Media')->using('App\Category_media');
    }

       public function category_media(){

        return $this->hasMany('App\Category_media');
    }


    
}

