<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Media;
use App\Category;
use App\Article;
use App\Comment;
use App\Role;
use App\Profilepic;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     use SoftDeletes;
      protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'email', 'password','anonymous','twitter','facebook','website','profilepicpath','povider','provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',


    ];

      public function media(){

        return $this->hasMany('App\Media');
    }

     public function comment(){

        return $this->hasMany('App\Comment');
    }

      public function article(){

        return $this->hasMany('App\Article');
    }

   

      public function Role(){

        return $this->belongsTo('App\Role');
    }

          public function Profilepic(){

        return $this->hasOne('App\Profilepic');
    }

        public function isAdmin(){

          $user=User::findOrFail(Auth::user()->id);

        if($user->role->name =="admin"){
            return true;
        }
            return false;

    }

        public function status($id){

            $user=User::findOrFail($id);

            if($user->article->count()==0){
                echo '
                <p> <i class="fa fa-star-0"></i><i class="fa fa-star-0"></i><i class="fa fa-star-0"></i><i class="fa fa-star-0"></i><i class="fa fa-star-0"></i></p><p>fakenews - newbie</p>';}
            elseif($user->article->count()<2){
                echo '<p> <i class="fa fa-star"></i><i class="fa fa-star-0"></i><i class="fa fa-star-0"></i><i class="fa fa-star-0"></i><i class="fa fa-star-0"></i></p><p>fakenews -recruit </p> <p> ✓ <small>fakenews-newbie</small></p> <hr>
                 <div class="progress">
                    <div class="progress-bar progress-bar-striped"   role="progressbar" style="width:' . ( $user->article->count()*20). '% ; background-color:tomato" aria-valuenow="50"   aria-valuemin="0" aria-valuemax="100"> </div>' . (5 - ($user->article->count())) . ' Articles to go </div>   <p><small>fakenews-sergant</small> -> <small>fakenews-master -> </small><small>fakenews-hero -></small><small>fakenews-superhero->??</small>';}

           elseif($user->article->count()<5){
                echo '<p> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-0"></i><i class="fa fa-star-0"></i><i class="fa fa-star-0"></i></p> <p>fakenews - sergant</p> <p> ✓ <small>fakenews-newbie</small> ✓  <small>fakenews-recrut</small> <hr>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped"   role="progressbar" style="width:' . $user->article->count()/5*100 . '% ; background-color:tomato" aria-valuenow="50"   aria-valuemin="0" aria-valuemax="100">' . (5 - ($user->article->count())) . ' Articles to go</div>   <p><small>fakenews-master*</small><small>fakenews-hero*</small><small>fakenews-superhero*</small>';}
           elseif($user->article->count()<10){
                echo '<p> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-0"></i><i class="fa fa-star-0"></i></p><p>fakenews - master</p> <p> ✓ <small>fakenews-newbie</small> ✓ <small>fakenews-recruit</small> ✓ <small>fakenews-sergant </small><hr>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped"   role="progressbar" style="width:' . (($user->article->count()-5)/5) *100 . '% ; background-color:tomato" aria-valuenow="50"   aria-valuemin="0" aria-valuemax="100"></div>' . (10 - ($user->article->count())) . '   ** Articles to go</div> <p><small>fakenews-hero*</small><small>fakenews-superhero*</small>';}
          elseif($user->article->count()<20){
                echo "fakenews - hero";}
          else{return "fakenews - superhero";}


        }



}
