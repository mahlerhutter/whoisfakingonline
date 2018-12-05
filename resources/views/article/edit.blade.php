



@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

@if(Auth::user()->id == $article->user->id)

	<div class="col-md-9" style="padding-top:50px"> 

		 
	<div class="col-md-7"> 

<h3>Edit article</h3>

<h5>{{$article->media->name}}</h5>
<img style="height: 110px;width:auto" class="card-img-top" src="{{asset('img/')}}/{{$article->media->picpath->logo}}">
<hr>

<form  method="PATCH" action="{{action('ArticleController@update',$article->id)}}" enctype="multipart/form-data">
	{{ csrf_field() }}

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">Topic</span>
  </div>
  <input type="text" class="form-control" name="topic" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="{{$article->topic}}">
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm"> Change Logo</span>
  </div>
  <input type="file"  name="pic">
</div>


<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">http://</span>
  </div>
  <input type="text" placeholder="{{$article->originallink}} class="form-control" name="originallink" >
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">http://</span>
  </div>
  <input type="text"  placeholder="{{$article->uncoversource}}"  class="form-control" name="uncoversource" >
</div>



<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">fake</span>
  </div>
  <textarea  style="width: 300px; height: 75px;background-color:#FFF5EE" placeholder="{{$article->reported}}"  class="form-control" rows="4" id="reported"   name="reported"></textarea>
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">reality</span>
  </div>
  <textarea  style="width: 300px; height: 75px;background-color:#9ACD32" placeholder="{{$article->reality}}" class="form-control" rows="4" id="reality"  name="reality"></textarea>
</div>







<div class="input-group">	
<input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="submit"></input>
</div>

</form>

</div>
@else

forbidden
@endif


@endsection