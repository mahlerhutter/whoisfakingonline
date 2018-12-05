@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

<div class="col-md-9" style="margin-top:40px">

@if(Auth::user()->email=='manuelmahlerhutter@gmail.com')

<a href="{{route('admin')}}">DASHBOARD</a>

<table class=table>

	
		<tr>
		<th>Comment</th>
		<th>user</th>
		<th>article/media</th>
		<th>crearted</th>
	
		
		
		

		</tr>
		@foreach($comments as $comment)
		<tr>
			<td>{{$comment->text}}</td>
			<td>{{$comment->user->name}}</td>
			<td>@if(isset($comment->media->name)){{$comment->media->name}} @else {{$comment->article_id}} @endif</td>
			
			<td>{{$comment->created_at->diffForHumans()}}</td>
			
		</tr>
@endforeach

	

</table>

@endif
@endsection