@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

<div class="col-md-2"> 

<a href="{{route('media.view',$article->media->id)}}">
@if(isset($article->media->picpath->logo))
<img src="{{asset('img/')}}/{{$article->media->picpath->logo}}" class="img-fluid img-thumbnail" style="height: 90px;width: 90px">
@else
{{$article->media->name}}
@endif
</a>

</div>


<div class="col-md-7">

<table class="table">
<tr>
	<td>Headline</td>
	<td>
		<strong>
{{$article->topic}} </strong></td>
</tr>
<tr>
<td>....they reported</td>
<td>
{{$article->reported}}
</td>
</tr>
<tr>
	<td>...but in fact...</td>
	<td>
{{$article->reality}}</td>
</tr>
<tr><td>FakeSource</td>
	<td><a href="{{$article->originallink}}">{{subStr($article->originallink,0,13)}}....</a> </td></tr>
<tr><td>Uncovered by</td>
	<td><a href="{{$article->uncoversource}}">{{subStr($article->uncoversource,0,13)}}....</a> </td></tr>
<tr><td>added</td>
	<td><small><p> 
		@if ($article->user->anonymous == 0){{$article->user->name}}
		@else anonymous
		@endif </p><p>{{($article->created_at->diffForHumans())}}</p></small></td></tr>



</table>

	@if($alreadyvoted==0)
	
	<a href="/article/{{$article->id}}/upvote">
	<i class="fa fa-angle-double-up" style="font-size:{{24*1+($upvotes/($downvotes+2))}}px">Upvote {{$upvotes}}</i></a>
	
	<a href="/article/{{$article->id}}/downvote">
		<i class="fa fa-angle-double-down" style="font-size:{{24*1+($downvotes/($upvotes+2))}}px">Downvote {{$downvotes}}</i><a>
	
	@elseif(($alreadyvoted==-1))
	
	<a href="/article/{{$article->id}}/upvote">
	<i class="fa fa-angle-double-up" style="font-size:{{24*1+($upvotes/($downvotes+2))}}px">Upvote {{$upvotes}}</i></a>

	<i class="fa fa-angle-double-down" style="font-size:{{24*1+($downvotes/($upvotes+2))}}px">Downvote {{$downvotes}}</i>
	
	@else
	
	<i class="fa fa-angle-double-up" style="font-size:{{24*1+($upvotes/($downvotes+2))}}px">Upvote {{$upvotes}}</i>
	
	<a href="/article/{{$article->id}}/downvote">
		<i class="fa fa-angle-double-down" style="font-size:{{24*1+($downvotes/($upvotes+2))}}px">Downvote {{$downvotes}}</i><a>

	@endif

	

</div>

@endsection