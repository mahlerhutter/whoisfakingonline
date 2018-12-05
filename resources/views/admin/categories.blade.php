
@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

<div class="col-md-9" style="margin-top:40px">



 @auth
  <div class="alert alert-light" role="alert">
  You are adding Media as {{Auth::user()->name}}
</div>
@else
<div class="alert alert-warning" role="alert">
  You might <a href="{{route('register')}}">register</a> or <a href="{{route('login')}}">login</a> to gain points and benefit from a faster review process.
</div>
@endauth


	<form method="POST" action="{{ action('CategoryController@store')}}" >
		{{ csrf_field() }}
		<div class="input-group">
			<input type="text" name="name" placeholder="...add category">

			
			<input type="email" name="added_by" placeholder="ur email">
			<input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">
		</div>
	</form>

  @foreach($categories as $category)
<p>
   <a href="">  <span class="badge badge-pill " style="color:{{$colorsv[rand(0,count($colorsv)-1)]}};background-color:{{$colorsh[rand(0,count($colorsh)-1)]}}"> {{$category->name}} </span> </a>

</p>
    @endforeach
</div>



@endsection