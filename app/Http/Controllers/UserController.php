<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\User;
use App\Media;
use App\Mediacategory;
use App\Category;
use App\Article;
use App\Role;

class UserController extends Controller
{
     public function show($id)

    {
        $media=Media::all();
         $categories=Category::all();

         $mediacount=$media->count();
         $lastcreated=$media->last();

        

         $mediacountreview=$media->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();



        $user=User::findOrFail($id);

        // if($user->id==Auth::user()->id){
        // 	return redirect('home');
        // }
        

        

        return view('user.show', compact('user','mediacount','mediacountreview','categoriescount','categoriescountreview','lastcreated','related'));

      


    }
}
