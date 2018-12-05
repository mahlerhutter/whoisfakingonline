<?php

namespace App\Http\Controllers;

use App\Article;

use App\Media;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::all();
       
        return view('article.index',compact('articles'));
    }

     public function view()
    {
        
       
        return view('article.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

       
        $medium=Media::findOrFail($id);

        return view('article.addarticle',compact('medium'));
    }

    public function fresh()

       {

        $medium=Media::all();

       
        
        return view('article.addfresh',compact('medium'));
    }


        public function random()

    {
        $media=Media::all();
        $categories=Category::all();
        $articlecount=Article::all()->count();

        

        $id=rand(1,$articlecount);

        

       

        $upvotes=DB::table('article_votes')->where('article_id',$id)->where('articlevote',1)->count('articlevote');
        $downvotes=DB::table('article_votes')->where('article_id',$id)->where('articlevote',-1)->count('articlevote');

        $alreadyvoted=DB::table('article_votes')->where('article_id', Auth::user()->id)->where('article_id', $id)->sum('articlevote');




        $article=Article::findOrFail($id);
         $comments=Comment::where('article_id', $id)->orderByDesc('created_at')->get();
        

        

        return view('article.show', compact('article','comments','upvotes','downvotes','alreadyvoted','related'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $article=Article::create($request->all());

         if(null!==$request->pic){

           $file = $request->file('pic');

            $name=time() . $file->getClientOriginalName();


            

            $file->move('articleimg', $name);                  

            DB::table('articlepics')->insert(
            ['article_id'=>$article->id,'path'=>$name]);};


         
        
         $comments=Comment::where('article_id', $article->id)->orderByDesc('created_at')->get();
         


        $upvotes=0;
        $downvotes=0;

        $alreadyvoted=0;

       




         return view('article.show',compact('article','upvotes','downvotes','alreadyvoted','comments'));

        return view('article.show',compact('article'));
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $article=Article::findOrFail($id);
         $comments=Comment::where('article_id', $id)->orderByDesc('created_at')->get();
         


        $upvotes=DB::table('article_votes')->where('article_id',$id)->where('articlevote',1)->count('articlevote');
        $downvotes=DB::table('article_votes')->where('article_id',$id)->where('articlevote',-1)->count('articlevote');

        if(Auth::user()){
        $alreadyvoted=DB::table('article_votes')->where('user_id', Auth::user()->id)->where('article_id', $id)->sum('articlevote');}    

       




         return view('article.show',compact('article','upvotes','downvotes','alreadyvoted','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::findOrFail($id);
         


         return view('article.show',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)

    {

        $article=Article::findOrFail($id);

      


        if($request['topic']!== null){
            $input['topic']=$request['topic'];
        }
          if($request['originallink']!== null){
            $input['originallink']=$request['originallink'];
        }
           if($request['uncoversource']!== null){
            $input['uncoversource']=$request['uncoversource'];
        }
         if($request['reported']!== null){
            $input['reported']=$request['reported'];
        }
         if($request['reality']!== null){
            $input['reality']=$request['reality'];
        }   

              if($file=$request->file('pic')){

                $name=time(). $file->getClientOriginalName();
                $file->move('articleimg', $name);
                DB::table('articlepics')->where(['article_id'=>$article->id])->delete();
                DB::table('articlepics')->insert(
                 ['article_id'=>$article->id,'path'=>$name]);}

     
        if(isset($input)){
        

         $article->update($input);}

            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
     
       $article=Article::findOrFail($id);
       if(Auth::user()->id == $article->user->id or Auth::user()->role->name == 'admin'){

       $article->delete();

        $articles=Article::all(); 

       Session::flash('message', 'Sucessfully deleted!!'); 
        Session::flash('alert-class', 'alert-danger'); }

       return view('article.index', compact('articles'));

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

        $upvotes=DB::table('article_votes')->where('article_id',$id)->where('articlevote',1)->count('articlevote');
        $downvotes=DB::table('article_votes')->where('article_id',$id)->where('articlevote',-1)->count('articlevote');

        $alreadyvoted=DB::table('article_votes')->where('article_id', Auth::user()->id)->where('article_id', $id)->sum('articlevote');

        

        $article=Article::findOrFail($id);

         

        return view('article.reviewit', compact('article','colorsv','colorsh','mediacount','mediacountreview','categoriescount','categoriescountreview','lastcreated','upvotes','downvotes','alreadyvoted'));


    }

}
