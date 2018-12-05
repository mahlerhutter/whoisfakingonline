<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;


class Role extends Model
{
    protected $fillable = [
       
          
            'topic','media_id','reported','reality','media_id','user_id','technice_id','originallink','uncoversource'
  
    ];


      public function user(){

        return $this->hasMany('App\User');
    }


    
}
