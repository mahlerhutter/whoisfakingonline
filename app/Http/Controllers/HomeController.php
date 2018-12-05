<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\User;
use App\Mediacategory;
use App\Category;
use App\Article;
use App\Role;
use Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()


    {

        $user=Auth::user();

        $categories=Category::all();
        $media=Media::all();
        $mediacount=$media->count();
        $lastcreated=$media->last();

        $mediacountreview=$media->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();
        return view('home',compact('media','mediacount','mediacountreview','categoriescount','categoriescountreview','lastcreated','user','categories'));

        
    }


    public function update(Request $request, $id){


        $user=User::findOrFail($id);

        if($request['name']!== null){
            $input['name']=$request['name'];
        }
        if($request['email']!== null){
            $input['email']=$request['email'];
        }
        if($request['website']!== null){
            $input['website']=$request['website'];
        }
        if($request['facebook']!== null){
            $input['facebook']=$request['facebook'];
        }
        if($request['twitter']!== null){
            $input['twitter']=$request['twitter'];
        }
       
         if(isset($request['anonymous'])){
            $input['anonymous']=$request['anonymous'];
        }

  

        if($file=$request->file('profilepic')){

                $name=time(). $file->getClientOriginalName();
                $file->move('profilepic', $name);
                DB::table('profilepics')->where(['user_id'=>Auth::user()->id])->delete();
                DB::table('profilepics')->insert(
                 ['user_id'=>Auth::user()->id,'path'=>$name]);}

         $user->update($input);

            return back();



    }
}
