<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Article;
use App\Media;

class Comment extends Model
{
   protected $fillable=[

   	'is_media','replyto_comment','user_id','media_id','article_id','commented_id','text',

   ];

      public function user(){

        return $this->belongsTo('App\User');
    }

    public function article(){

        return $this->belongsTo('App\Article');
    }

     public function media(){

        return $this->belongsTo('App\Media');
    }

    public function make_links_clickable($text){
    $text1= preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $text);
    $text2= preg_replace("/(^|[\n ])([\w]*?)((www|wap)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" >$3</a>", $text1);
    return $text2;
}

}
