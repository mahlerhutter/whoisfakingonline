<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Picpath;


class Picpath extends Model
{
    protected $fillable = [
        'logo','media_id'
    ];

     public function media(){

        return $this->hasOne('App\User');
    }

    
}

