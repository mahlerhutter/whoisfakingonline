<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Picpath;
use App\Article;
use App\MediaVote;

class Media extends Model
{
    	 use SoftDeletes;
      protected $dates = ['deleted_at'];

      protected $fillable = [
    		'name','bio','picpath','website','facebook','twitter','legalowner','finalprincipal','seemstobe','inorderto','audience','country','is_active','added_by','user_id','deleted_at'
            
  
    ];

      public function category(){

        return $this->belongsToMany('App\Category');
    }

          public function user(){

        return $this->belongsTo('App\User');
    }

       public function picpath(){

        return $this->hasOne('App\Picpath');
    }

      public function article(){

        return $this->hasMany('App\Article');
    }


     public function media_votes(){

        return $this->hasMany('App\Media_vote');
    }

   


   





}
