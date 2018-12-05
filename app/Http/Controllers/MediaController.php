<?php

namespace App\Http\Controllers;



use App\Media;
use App\Mediacategory;
use App\Category;
use App\Comment;
use App\Media_vote;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $media=Media::all();
        $categories=Category::all();
    
        $mediacount=$media->count();
        $lastcreated=$media->last();

        $mediacountreview=$media->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();


   return view('media.index', compact('media','mediacount','mediacountreview','categoriescount','categoriescountreview', 'lastcreated','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories=Category::all();


      $media=Media::all();
      $mediacount=$media->count();
       $lastcreated=$media->last();

       $thiscategories=0;

        $mediacountreview=$media->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();

      $colorsv=array('pink','lightSalmon','yellow','pink','lime','lightgreen','lightcyan','LemonChiffon','LightSteelBlue','Lavender','MintCream');

      $colorsh=array('DarkSlateGray','DimGray','Indigo','DarkOrchid','Fuchsia','Maroon','brown','Navy','Teal','DarkGreen','DarkRed');



      return view('media.add', compact('categories','colorsv','colorsh','mediacount','mediacountreview','categoriescount','categoriescountreview','lastcreated','media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
      
        $media=Media::create($request->all());

        if(null!==$request->logo){

            $file = $request->file('logo');

            $name=time() . $file->getClientOriginalName();




            

            $file->move('img', $name);                  

            DB::table('picpaths')->insert(
            ['media_id'=>$media->id,'logo'=>$name]);};



      if(isset($request->related)){
        foreach ($request->related as $related) {
            $relatedname=Media::findOrFail($related)->name;
        DB::table('relatedmedia')->insert(
            ['media_id'=>$media->id,'related_id'=>$related,'related_name'=>$relatedname]);}}
    

        if(isset($request->category)){
        foreach ($request->category as $category) {
        DB::table('category_media')->insert(
            ['media_id'=>$media->id,'category_id'=>$category]);}}

      
    
        $categories=Category::all();
        $medium=$media;
          $thiscategories=0;





        $colorsv=array('pink','lightSalmon','yellow','pink','lime','lightgreen','lightcyan','LemonChiffon','LightSteelBlue','Lavender','MintCream');

      $colorsh=array('DarkSlateGray','DimGray','Indigo','DarkOrchid','Fuchsia','Maroon','brown','Navy','Teal','DarkGreen','DarkRed');

       $related=DB::table('relatedmedia')->where('media_id',$medium->id)->get();
        $comments=Comment::where('media_id', $medium->id)->orderByDesc('created_at')->get();



      return view('media.view', compact('categories','colorsv','colorsh','media','related','comments','medium'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        $allmedia=Media::all();
        $categories=Category::all();
        $comments=Comment::where('media_id', $id)->orderByDesc('created_at')->get();

        $mediacount=$allmedia->count();
        $lastcreated=$allmedia->last();

        $related=DB::table('relatedmedia')->where('media_id',$id)->get();


        $mediacountreview=$allmedia->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();

        $medium=Media::findOrFail($id);
        $thiscategories=$medium->category->all();
        

         $colorsv=array('pink','lightSalmon','yellow','pink','lime','lightgreen','lightcyan','LemonChiffon','LightSteelBlue','Lavender','MintCream');

      $colorsh=array('DarkSlateGray','DimGray','Indigo','DarkOrchid','Fuchsia','Maroon','brown','Navy','Teal','DarkGreen','DarkRed');

        return view('media.view', compact('medium','colorsv','colorsh','mediacount','mediacountreview','allmedia','categoriescount','categoriescountreview','lastcreated','picpath','related','comments','categories','thiscategories'));


    }

    public function random()

    {
        
        $allmedia=Media::all();

        
        $mediacount=$allmedia->count();
        $id=rand(1,$mediacount);

        $categories=Category::all();
        $comments=Comment::where('media_id', $id)->orderByDesc('created_at')->get();

       
        $lastcreated=$allmedia->last();

        $related=DB::table('relatedmedia')->where('media_id',$id)->get();


        $mediacountreview=$allmedia->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();


        $id=rand(1,$mediacount);

        
        $medium=Media::findOrFail($id);
        

         $colorsv=array('pink','lightSalmon','yellow','pink','lime','lightgreen','lightcyan','LemonChiffon','LightSteelBlue','Lavender','MintCream');

      $colorsh=array('DarkSlateGray','DimGray','Indigo','DarkOrchid','Fuchsia','Maroon','brown','Navy','Teal','DarkGreen','DarkRed');

        return view('media.view', compact('medium','colorsv','colorsh','mediacount','mediacountreview','categoriescount','categoriescountreview','lastcreated','picpath','related'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
      $medium=Media::findOrFail($id);

  

      


        if($request['name']!== null){
            $input['name']=$request['name'];
        }
          if($request['finalprincipal']!== null){
            $input['finalprincipal']=$request['finalprincipal'];
        }
           if($request['country']!== null){
            $input['country']=$request['country'];
        }
         if($request['website']!== null){
            $input['website']=$request['website'];
        }
         if($request['facebook']!== null){
            $input['facebook']=$request['facebook'];
        }  

        if($request['youtube']!== null){
            $input['youtube']=$request['youtube'];
        }  
        if($request['twitter']!== null){
            $input['twitter']=$request['twitter'];
        }  
        if($request['bio']!== null){
            $input['bio']=$request['bio'];
        }   

              if($file=$request->file('logo')){

                $name=time(). $file->getClientOriginalName();
                $file->move('img', $name);
                DB::table('picpaths')->where(['media_id'=>$medium->id])->delete();
                DB::table('picpaths')->insert(
                 ['media_id'=>$medium->id,'logo'=>$name]);}

        if(isset($request->related)){
       
        foreach ($request->related as $related) {
            $relatedname=Media::findOrFail($related)->name;
        DB::table('relatedmedia')->insert(
            ['media_id'=>$medium->id,'related_id'=>$related,'related_name'=>$relatedname]);}}
    

        if(isset($request->category)){
        foreach ($request->category as $category) {
        DB::table('category_media')->insert(
            ['media_id'=>$medium->id,'category_id'=>$category]);}}


        if(isset($input)){

     

         $medium->update($input);
         }

            return back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        
        $media=Media::findOrFail($id);
        if(Auth::user()->id == $media->user->id or Auth::user()->role->name == 'admin'){
        $media->delete();}  

        $media=Media::all();
        $categories=Category::all();
    
       
      

        $mediacount=$media->count();
        $lastcreated=$media->last();

        $mediacountreview=$media->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();
        Session::flash('message', 'Sucessfully deleted!!'); 
        Session::flash('alert-class', 'alert-danger'); 

        return view('media.index', compact('media','mediacount','mediacountreview','categoriescount','categoriescountreview', 'lastcreated'));
    }

     public function review()
    {
        $mediareview=Media::where('is_active','0')->get();
        $categories=Category::all();
        $media=Media::all();
        $mediacount=$media->count();
        $lastcreated=$media->last();

        $mediacountreview=$media->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();


   return view('media.review', compact('media','mediareview','mediacount','mediacountreview','categoriescount','categoriescountreview','lastcreated'));
    }

     public function about()
    {
        
        $categories=Category::all();
        $media=Media::all();
        $mediacount=$media->count();
        $lastcreated=$media->last();

        $mediacountreview=$media->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();


   return view('about', compact('media','mediacount','mediacountreview','categoriescount','categoriescountreview','lastcreated'));
    }

         public function register()
    {
        
        $categories=Category::all();
        $media=Media::all();
        $mediacount=$media->count();
        $lastcreated=$media->last();

        $mediacountreview=$media->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();


   return view('auth.register', compact('media','mediacount','mediacountreview','categoriescount','categoriescountreview','lastcreated'));
  
}

      public function login()
    {
        
        $categories=Category::all();
        $media=Media::all();
        $mediacount=$media->count();
        $lastcreated=$media->last();

        $mediacountreview=$media->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();


   return view('auth.login', compact('media','mediacount','mediacountreview','categoriescount','categoriescountreview','lastcreated'));
  
}

 public function reviewit($id)
    {
        $media=Media::all();
        $categories=Category::all();

        $mediacount=$media->count();
        $lastcreated=$media->last();

        $mediacountreview=$media->where('is_active',0)->count();

        $categoriescount=$categories->count();
        $categoriescountreview=$categories->where('is_active',0)->count();

        $upvotes=DB::table('media_votes')->where('media_id',$id)->where('mediavote',1)->count('mediavote');
        $downvotes=DB::table('media_votes')->where('media_id',$id)->where('mediavote',-1)->count('mediavote');

        $alreadyvoted=DB::table('media_votes')->where('user_id', Auth::user()->id)->where('media_id', $id)->sum('mediavote');

        

        $medium=Media::findOrFail($id);

         

        return view('media.reviewit', compact('medium','colorsv','colorsh','mediacount','mediacountreview','categoriescount','categoriescountreview','lastcreated','upvotes','downvotes','alreadyvoted'));


    }


 

 public function search()
    {

        $q=Input::get('q');

      
      
 
    $media= Media::where('name','LIKE','%'.$q.'%')->get();
  
   if(count($media) > 0)
   return view('article.add', compact('media'));
  else return view ('article.add', compact('q'));
}


}




