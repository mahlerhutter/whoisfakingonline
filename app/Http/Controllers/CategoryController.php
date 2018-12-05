<?php

namespace App\Http\Controllers;

use App\Media;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category=new Category;
        $category->name=request('name');
        $category->added_by=request('added_by');
        $category->is_active=0;
        $category->save();

        $categories=Category::all();

        $colorsv=array('pink','lightSalmon','yellow','pink','lime','lightgreen','lightcyan','LemonChiffon','LightSteelBlue','Lavender','MintCream');
      
      $colorsh=array('DarkSlateGray','DimGray','Indigo','DarkOrchid','Fuchsia','Maroon','brown','Navy','Teal','DarkGreen','DarkRed');

        return view('admin.categories', compact('categories','colorsv','colorsh'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

   $qcategories=DB::table('category_media')->where('category_id',$id)->get(['media_id']);
   $categoryname=Category::findOrFail($id);
   

 

 

 $media_id=array();
   
   for($i=0; $i < count($qcategories); $i++){
    $media_id[]=$qcategories[$i]->media_id;

   } 
  
    // dd($media_id);

   //$qmedia_id=$qcategories->media_id;
   $media=Media::whereIn('id',$media_id)->get(); 

   //dd($media);




       return view('media.index',compact('media','categoryname'));
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
    public function update(Request $request, media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(media $media)
    {
        //
    }
}
