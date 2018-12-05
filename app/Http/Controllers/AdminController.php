<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use App\Media;
use App\Category;
use App\Message;
use App\Comment;

use Illuminate\Support\Facades\DB;
use Auth;

class AdminController extends Controller
{
    
    public function index()
    {
        $user=User::all();
        $messages=Message::all();
        $anon=User::where('anonymous',1)->count();
        $latestuser=User::orderBy('created_at','desc')->first();
        $categories=Category::all();

        $article=Article::all();
       
        $latestarticle=Article::orderBy('created_at','desc')->first();
       
        return view('admin.dashboard',compact('user','anon','latestuser','article','latestarticle','messages','categories'));
    }


        public function categories()
    {
        
        $categories=Category::all();

        $article=Article::all();

          $colorsv=array('pink','lightSalmon','yellow','pink','lime','lightgreen','lightcyan','LemonChiffon','LightSteelBlue','Lavender','MintCream');

      $colorsh=array('DarkSlateGray','DimGray','Indigo','DarkOrchid','Fuchsia','Maroon','brown','Navy','Teal','DarkGreen','DarkRed');


       
        
       
        return view('admin.categories',compact('article','categories', 'colorsv','colorsh'));
    }

    public function messages()
    {
        
        $messages=Message::orderBy('created_at','desc')->paginate(4);
        
       
        return view('admin.messages',compact('messages'));
    }

     public function users()
    {
        
        $users=User::orderBy('created_at','desc')->paginate(250);
        
       
        return view('admin.users',compact('users'));
    }

      public function articles()
    {
        
        $articles=Article::orderBy('created_at','desc')->paginate(250);
        
       
        return view('admin.articles',compact('articles'));
    }

    public function media()
    {
        
        $media=Media::orderBy('created_at','desc')->paginate(250);
        
       
        return view('admin.media',compact('media'));
    }

     public function comments()
    {
        
        $comments=Comment::orderBy('created_at','desc')->paginate(250);
        
       
        return view('admin.comments',compact('comments'));
    }



}
