
@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')


<div class="col-md-9"> 

		<table class="table  table-striped table-hover">

 <thead>
    <tr>
       <th scope="col">Medium</th>
      <th scope="col">Topic</th>
      <th scope="col">Fake source</th>
      <th scope="col">Fakenews</th>
      <th scope="col">Reality</th>
      
 
     
      
    </tr>
  </thead>
  <tbody>



@foreach ($articles as $article)
<tr>
<td>
<a href="{{route('media.view',$article->media->id)}}">
@if(isset($article->media->picpath->logo))
<img src="/img/{{$article->media->picpath->logo}}" class="img-fluid img-thumbnail" style="height: 70px;width: 70px">
@else
{{$article->media->name}}
@endif
</a>
</td>
<td>
  <a href="{{route('article.show',$article->id)}}">
{{$article->topic}}
</a>
</td>
<td>
{{$article->originallink}}
</td>
<td>
{{subStr($article->reported,0,142)}}<a href="{{route('article.show',$article->id)}}">...</a>
</td>
<td>
{{subStr($article->reality,0,142)}}<a href="{{route('article.show',$article->id)}}">...</a>
</td>

</tr>
@endforeach


</tbody>
</table>
</div>

@endsection