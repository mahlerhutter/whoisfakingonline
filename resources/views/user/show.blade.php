


@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')


<div class="col-md-9" style="padding-top:40px">



@if($user->anonymous==1)

<div class="alert alert-primary" role="alert">
  This user is  anonymous.
</div>
@else



<div class="row"> 
	<div class=col-md-4>
		<p><img class="img img-thumbnail img-responsive" style="height: 120px;width: 120px" src="{{asset('profilepic')}}/{{$user->profilepic->path}}"></p>

		
		<i class="fa fa-twitter" style="font-size:24px"></i>

		{{$user->status($user->id)}}
	</div>

	<div class=col-md-8>

		<table class="table">


	<tr><td>Name</td><td>{{$user->name}} </td>  </tr>

	<tr><td>email</td><td>{{$user->email}} </td>  </tr>
	<tr><td>Website</td><td>{{$user->website}} </td>  </tr>
	<tr><td>Facebook</td><td>{{$user->facebook}} </td>  </tr>
	<tr><td>twitter</td><td>{{$user->twitter}} </td>  </tr>


	</table>




</div>
@endif


</div>
@endsection

