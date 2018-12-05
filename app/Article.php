<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Article;
use App\Media;
use App\Comment;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
   
     use SoftDeletes;
      protected $dates = ['deleted_at'];
    protected $fillable = [
       
          
            'topic','media_id','reported','reality','media_id','user_id','technice_id','originallink','uncoversource','deleted_at'
  
    ];


      public function media(){

        return $this->belongsTo('App\Media')->withTrashed();
    }

    public function user(){

        return $this->belongsTo('App\User');
    }

       public function Articlepic(){

        return $this->hasOne('App\Articlepic');
    }


       public function Comment(){

        return $this->hasMany('App\Comment');
    }
    
}
