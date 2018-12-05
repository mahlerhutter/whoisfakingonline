@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

<div class="col-md-9" style="margin-top:40px">

@if(Auth::user()->email=='manuelmahlerhutter@gmail.com')

<a href="{{route('admin')}}">DASHBOARD</a>

<table class=table>

	
		<tr>
		<th>Message</th>
		<th>User</th>
		<th>email</th>
		<th>time</th>

		</tr>
		@foreach($messages as $message)
		<tr>
			<td>{{$message->text}}</td>
			<td>@if(isset($message->user_id)) 
				{{$message->user->name}}
			@endif</td>
			<td>{{$message->email}}</td>
			<td>{{$message->created_at->diffForHumans()}}</td>
		</tr>
@endforeach

	

</table>

@else
not allowed
@endif
@endsection