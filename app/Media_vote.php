<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Media;
use App\User;

class media_vote extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'media_id', 'mediavote',
    ];


        public function user(){

        return $this->hasOne('App\User');
    }

      public function media(){

        return $this->belongsTo('App\Media');
    }

     
}
