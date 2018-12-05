@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

<div class="col-md-9" style="margin-top:40px">

@if(Auth::user()->email=='manuelmahlerhutter@gmail.com')

<a href="{{route('admin')}}">DASHBOARD</a>

<table class=table>

	
		<tr>
		<th>User</th>
		<th>email</th>
		<th>created</th>
		<th>media added</th>
		
		<th>articles added</th>

		</tr>
		@foreach($users as $user)
		<tr>
			<td>{{$user->name}}</td>
			<td>{{$user->email}}</td>
			<td>{{$user->created_at->diffForHumans()}}</td>
			<td>{{$user->media->count('id')}}</td>
			<td>{{$user->article->count('id')}}</td>
			
		</tr>
@endforeach

	

</table>

@endif
@endsection