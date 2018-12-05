@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

<div class="col-md-9" style="margin-top:40px">

@if(Auth::user()->email=='manuelmahlerhutter@gmail.com')

<a href="{{route('admin')}}">DASHBOARD</a>

<table class=table>

	
		<tr>
		<th>Topic</th>
		<th>User</th>
		<th>created</th>
		<th>articles added</th>


		</tr>
		@foreach($articles as $article)
		<tr>
			<td><a href="{{route('article.show',$article->id)}}">{{$article->topic}}</a></td>
			<td>{{$article->user->name}}</td>
			<td>{{$article->created_at->diffForHumans()}}</td>
			<td>{{$article->user->count('id')}}</td>
			
			
		</tr>
@endforeach

	

</table>

@endif
@endsection