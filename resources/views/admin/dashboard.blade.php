
@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

<div class="col-md-9" style="margin-top:40px">

@if(Auth::user()->email=='manuelmahlerhutter@gmail.com')

<div class="row">

<div class="col-md-3">
	<div class="card" style="width: 15rem; width:15rem; background-color: tomato">
  <div class="card-body">
    <h5 class="card-title">Users</h5>
    <h6 class="card-subtitle mb-2 text-muted">Number: {{$user->count()}}</h6>
    <p class="card-text">
    	<ul>
    		<li>Latest User : <a href="{{route('user.show',$latestuser->id)}}">{{$latestuser->name}}</a></li>
    		
    	


    	</ul>

      <a href="{{route('admin.users')}}" class="card-link">ALL Users</a>

   </p>

  </div>
</div>

</div>

<div class="col-md-3">
	<div class="card" style="width: 15rem; width:15rem; background-color: green">
  <div class="card-body">
    <h5 class="card-title">Articles</h5>
    <h6 class="card-subtitle mb-2 text-muted">Subscribed</h6>
    <p class="card-text"><ul>
    		<li>Latest Article: <a href="{{route('article.show',$latestarticle->id)}}"> {{$latestarticle->topic}}</a></li>
    		

    	</ul>
      <a href="{{route('admin.articles')}}" class="card-link">ALL Articles</a>
</p>
    

  </div>
</div>
</div>

<div class="col-md-3"> 
	<div class="card" style="width: 15rem; width:15rem; background-color: yellow">
  <div class="card-body">
    <h5 class="card-title">Messages</h5>
   
    <p class="card-text"><ul>
     <li> Total Messages{{$messages->count()}}  </li>
     <li> Latest Message:{{$messages->count()}}  </li>

   </ul></p>
    <a href="{{route('admin.messages')}}" class="card-link">ALL Messages</a>

  </div></div>
</div>
</div>
<div class="row">

<div class="col-md-3">
	<div class="card" style="width: 15rem; width:15rem; background-color: yellow">
  <div class="card-body">
    <h5 class="card-title">Category</h5>
    
    <p class="card-text"><ul>@foreach ($categories as $category)
     <li> {{$category->name}} / {{$category->is_active}} </li>@endforeach</ul></p>
    
    <a href="#" class="card-link">Card link</a>
   
  </div></div>
</div>

<div class="col-md-3">
  <div class="card" style="width: 15rem; width:15rem; background-color: yellow">
  <div class="card-body">
    <h5 class="card-title">Comments</h5>

     <a href="{{route('admin.comments')}}" class="card-link">All Comments</a>

  </div></div>
</div>



@else
not authorized
@endif


</div>

@endsection
